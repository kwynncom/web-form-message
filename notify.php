<?php

require_once('/opt/kwynn/kwutils.php');
require_once('/opt/kwynn/email.php');
require_once(__DIR__ . '/srv/serverDB.php');

class notify_email_msgs extends dao_msg {

	const nsd = 'nsd';

	public function __construct() {	
		parent::__construct();
		$this->setup();
		$this->do10(); 
	}
	
	private function setup() {
		$this->creTabs(['n' => 'notice']);
	}
	
	private function do10() { 
		$k = self::nsd;
		$nnc = $this->mcoll->count([$k => ['$ne' => 'sent']]); 
		if ($nnc === 0) return; // sent versus seen
		$this->do20();
		return;
	}
	
	private function do20() {
		$cnt = $this->ncoll->count();
		if ($cnt > 0) return;
		$this->do30();
	}
	
	private function do30() {
		$emr = kwynn_email::send('notify', 'testing - no limits yet');
		$ts = $dat['ts'] = time(); $dat['r'] = date('r', $ts);
		$dat['emstatus'] = $emr;
		$this->ncoll->insertOne($dat);
		$nsd = self::nsd;
		if ($emr) $res = $this->mcoll->updateMany([$nsd => 'sweep'], ['$set' => [$nsd => 'sent']]);
	}
	
}

new notify_email_msgs();
