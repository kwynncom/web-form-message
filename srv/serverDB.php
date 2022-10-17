<?php

require_once(__DIR__ . '/../config.php');

class dao_msg extends dao_generic_3 {
    const dbName = 'user_form_msgs';

    public function __construct() {
		parent::__construct(self::dbName, __FILE__);
		$this->creTabs(['m' => 'msgs']);
		$this->otherDB();
    }

	private function otherDB() { $this->mcoll->createIndex(['pubid' => -1], ['unique' => true]);	}
	
	public function getPubListI() {
		$res = $this->mcoll->find([], ['sort' => ['cre_ts' => 1], 
					'projection' => ['_id' => 0, 'up_ts' => 1, 'cre_ts' => 1, 'len' => 1, 'pubid' => 1]]);
		return $res;
	}
	
	public static function getPubList() { $o = new self(); return $o->getPubListI(); }
	
	public static function valOrDie($a) {
		kwas(is_array($a) && count($a) >= 3, 'bad input count - 0244'); unset($a['eleType']);
		kwas(dao_generic_3::oidsvd($a['pageid'], TRUE), 'bad pageid');
		kwas(is_string($a['v']) && strlen($a['v']) <= KW_MSG_2021_1226_1_MAXLEN, 'not string / too long');	
		kwas($a['eid'] === 'msg', 'bad input property - 0243');
		return $a;
	}
	
	public function putMsgOrDie($ain) {
		$a = self::valOrDie ($ain); unset($ain);
		$ids = $a['pageid'] . '-' . $a['eid'];
		unset ($a['pageid']);
		$u = ['_id' => $ids];
		$a['len'] = strlen($a['v']);
		$r = $this->mcoll->upsert($u, $a);

		return $this->retHTTP($r, $u, $a['v']);
	}
	
	private function setPubKey($u, $mc) {
		if ($mc > 0) return;
		$this->mcoll->upsert($u, ['pubid' => dao_generic_3::get_oids()]);
	}

	private function retHTTP($dbrin, $u, $vin) {
		$okr = ['u' => $u, 'v' => $vin, 'kwdbss' => 'OK', 'len' => strlen($vin) ];
		$t = $dbrin;
		$mc = $t->getMatchedCount();
		$this->setPubKey($u, $mc);

		if ( $t->getUpsertedCount() === 1) return $okr;
		if ( $t->getModifiedCount() === 1) return $okr;
		kwas($mc === 1 , 'neither matched nor modified');

		$r = $this->mcoll->findOne($u); kwas(isset($r['v']), 'checking for already-saved value and found nothing');
		if ($r['v'] === $vin) return $okr;

		throw new Exception('neither saved nor already in db');
	}

	public static function getMsg($pubid) {
		$o = new self();
		return $o->getMsgI($pubid);
	}
	
	public function getMsgI($pubid) {
		return $this->mcoll->findOne(['pubid' => $pubid]);
	}
	
}
