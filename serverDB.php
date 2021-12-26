<?php

require_once('/opt/kwynn/kwutils.php');
require_once(__DIR__ . '/config.php');

class dao_jsio_example extends dao_generic_3 {
    const dbName = 'user_form_msgs';

    public function __construct() {
		parent::__construct(self::dbName, __FILE__);
		$this->creTabs(['m' => 'msgs']);
		$this->clean();
    }

	private function clean() {
		// if (!isAWS() & time() < strtotime('2021-12-26 03:50')) $this->mcoll->drop();
	}
	
	public static function valOrDie($a) {
		kwas(is_array($a) && count($a) === 3, 'bad input count - 0244');
		kwas(uoids_is_valid($a['pageid']), 'bad pageid');
		kwas(is_string($a['v']) && strlen($a['v']) <= KW_MSG_2021_1226_1_MAXLEN, 'not string / too long');	
		kwas($a['eid'] === 'msg', 'bad input property - 0243');
		return $a;
	}
	
	public function putOrDie($ain) {
		$a = self::valOrDie ($ain); unset($ain);
		$ids = $a['pageid'] . '-' . $a['eid'];
		unset ($a['pageid']);
		$u = ['_id' => $ids];
		$a['len'] = strlen($a['v']);
		$r = $this->mcoll->upsert($u, $a);

		return $this->retHTTP($r, $u, $a['v']);
	}

	private function retHTTP($dbrin, $u, $vin) {
		$okr = ['u' => $u, 'v' => $vin, 'kwdbss' => 'OK', 'len' => strlen($vin) ];
		$t = $dbrin;
		if ( $t->getUpsertedCount() === 1) return $okr;
		if ( $t->getModifiedCount() === 1) return $okr;
		kwas($t->getMatchedCount () === 1 , 'neither matched nor modified');

		$r = $this->mcoll->findOne($u); kwas(isset($r['v']), 'checking for already-saved value and found nothing');
		if ($r['v'] === $vin) return $okr;

		throw new Exception('neither saved nor already in db');
	}

}
