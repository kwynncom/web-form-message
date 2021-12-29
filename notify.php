<?php

require_once('/opt/kwynn/kwutils.php');
require_once('/opt/kwynn/email.php');
require_once(__DIR__ . '/srv/serverDB.php');

class notify_email_msgs extends dao_msg {

	const nsd = 'nsd';
	const maxSendS = 10000;
	// const maxSendS = -1;
	
	public function __construct() {	
		parent::__construct();
		$this->setup();
		$this->do10(); 
	}
	
	private function setup() {
		$this->creTabs(['n' => 'prenot']);
	}
	
	private function do10() { 
		$nsd = self::nsd;
		$res = $this->mcoll->count([$nsd => ['$nin' => ['seen', 'sent']]]); 
		if (!$res) return;
		$this->do20();
		return;
	}
	
	private function do20() { // Wed 12/29 - set a seen button in list; it sets as seen and drops the notice / prenot table (collection)
		$ba = [0.1, 1, 3, 5, 10, 20, 40];
		// $ba = [0.0001, 0.0002, 0.003, 0.0004, 0.00001, 0.0003, 3, 5];
		$ban = count($ba);
		$now = time();

		for ($i = $ban - 1; $i >=0; $i--) {
			$ckts = intval(round($now - 3600 * $ba[$i]));
			$ckhu = date('r', $ckts);
			$dbn = $this->ncoll->count(['ts' => ['$gt' => $ckts]]);
			if ($dbn === 0) break;
			if ($dbn > $i) return;
		}
		

		$this->do30();
	}
	
	private function do30() {
		$ts = $dat['ts'] = time(); $dat['r'] = date('r', $ts);
		$this->ncoll->insertOne($dat);
		$emr = kwynn_email::send('notify', 'testing - no limits yet');
		$nsd = self::nsd;
		if ($emr) $res = $this->mcoll->updateMany([$nsd => ['$nin' => ['seen', 'sent']]], ['$set' => [$nsd => 'sent']]);
	}
	
}

new notify_email_msgs();
