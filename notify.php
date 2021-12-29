<?php

require_once('/opt/kwynn/kwutils.php');
require_once('/opt/kwynn/email.php');
require_once(__DIR__ . '/srv/serverDB.php');

class notify_email_msgs extends dao_msg {
	public function __construct() {
		parent::__construct();
		$this->setup();
		// $this->do10(); // kwynn_email::send('notify', 'testing - no limits yet');
	}
	
	private function setup() {
		$this->creTabs(['n' => 'notify']);
		
	}
	
	private function do10() { 
		$now = $dat['ts'] = time();
		$dat['r'] = date('r', $now);
		$dat['sapi'] = iscli() ? 'cli' : 'web';
		$this->ncoll->insertOne($dat);
	}
}

new notify_email_msgs();
