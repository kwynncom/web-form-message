<?php

require_once('/opt/kwynn/kwutils.php');

class dao_jsio_example extends dao_generic_3 {
    const dbName = 'jsio_tests';

    public function __construct() {
		parent::__construct(self::dbName, __FILE__);
		$this->creTabs(['j' => 'jsdat']);
		$this->clean();
    }

	private function clean() {
		// if (!isAWS() & time() < strtotime('2021-12-26 03:00')) $this->jcoll->drop();
	}
	
	public function putOrDie($a) {
		$ids = $a['pageid'] . '-' . $a['eid'];
		unset ($a['pageid']);
		$u = ['_id' => $ids];
		$r = $this->jcoll->upsert($u, $a);

		return $this->retHTTP($r, $u, $a['v']);
	}

	private function retHTTP($dbrin, $u, $vin) {
		$okr = ['u' => $u, 'v' => $vin, 'kwdbss' => 'OK'];
		$t = $dbrin;
		if ( $t->getUpsertedCount() === 1) return $okr;
		if ( $t->getModifiedCount() === 1) return $okr;
		kwas($t->getMatchedCount () === 1 , 'neither matched nor modified');

		$r = $this->jcoll->findOne($u); kwas(isset($r['v']), 'checking for already-saved value and found nothing');
		if ($r['v'] === $vin) return $okr;

		throw new Exception('neither saved nor already in db');
	}

}
