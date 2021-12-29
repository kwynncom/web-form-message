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
	}
	
	private function do10() { 
		$nsd = self::nsd;
		$cnt = $this->mcoll->count([$nsd => ['$ne' => 'seen']]); 
		if ($cnt === 0) return;
		$cnt = $this->mcoll->count([$nsd => ['$ne' => 'sent']]); 
		if ($cnt === 0) return;
		$this->do20();
		return;
	}
	
	private function do20() {
		$res = $this->mcoll->findOne([self::nsd => ['$ne' => 'sent']], ['sort' => ['cre_ts' => -1]]);
		if (!$res) return;
		$max = $res['cre_ts'];
		if (time() - self::maxSendS < $max) return;

		$this->do30();
	}
	
	private function do30() {
		$emr = kwynn_email::send('notify', 'testing - no limits yet');
		$nsd = self::nsd;
		if ($emr) $res = $this->mcoll->updateMany([$nsd => ['$nin' => ['seen', 'sent']]], ['$set' => [$nsd => 'sent']]);
	}
	
}

new notify_email_msgs();
