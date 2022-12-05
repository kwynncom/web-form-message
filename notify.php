<?php

require_once('/opt/kwynn/kwutils.php');
require_once('/opt/kwynn/email.php');
require_once(__DIR__ . '/srv/serverDB.php');
require_once(__DIR__ . '/log/log.php');

class notify_email_msgs extends dao_msg {

	const nsd = 'nsd';
	const maxSendS = 10000;
	// const maxSendS = -1;
	
	public $matmod = [];
	
	public function __construct($markAsSeenA = false) {	
		parent::__construct();
		$this->setup();
		if ($markAsSeenA) $this->markAsSeen($markAsSeenA);
		else $this->do10(); 
	}
	
	private function setup() {
		$this->creTabs(['n' => 'prenot']);
	}
	
	private function markAsSeen($a) {
		kwas(is_array($a), 'improper type markAsSeen - 1809');
		foreach($a as $rraw) {
			$puid = dao_generic_3::oidsvd($rraw);
			continue;
		}
		
		$dres = $this->ncoll->drop(); // can be "not found" and leak too much info to return without processing
		$res = $this->mcoll->upsertMany(['pubid' => ['$in' => $a]], [self::nsd => 'seen']);
		$mat = $ret['mat'] = $res->getMatchedCount(); kwas($mat === count($a), 'all rows should match - markAsSeen 1810');
		$ret['status'] = 'OK';
		$ret['mod'] = $res->getModifiedCount();
		$this->matmod = $ret;
	}
	
	private function do10() { 
		
		$this->logInit();
		
		$nsd = self::nsd;
		$res = $this->mcoll->count([$nsd => ['$nin' => ['seen', 'sent']]]); 
		if (!$res) return;
		
		$this->logo->log("unseen = $res");
		
		$this->do20();
		return;
	}
	
	private function logInit() {
		$this->logo = new webFormMsgLog();
		$tot = $this->mcoll->count(); 
		$this->logo->log("tot = $tot");
	}
	
	private function do20() {
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
		$emr = kwynn_email::send('new web form msg', self::nmsg(), TRUE);
		$nsd = self::nsd;
		if ($emr) $res = $this->mcoll->updateMany([$nsd => ['$nin' => ['seen', 'sent']]], ['$set' => [$nsd => 'sent']]);
	}
	
	public static function nmsg() {
		$nmsg = <<<'NMSG'
		  <p><a href='https://kwynn.com/t/22/01/msg22/list/listTP.php'>list</a></p>
NMSG;
		
		return $nmsg;
	}
	
}

new notify_email_msgs();
