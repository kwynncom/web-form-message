<?php

class webFormMsgLog {
	
	const fnamePre = '/tmp/webformmsglog';
	const fnameSfx = '.txt';
	const defaultDisplayLines = 30;
	
	public function __construct() {
		$this->log('first');
	}
	
	public function __destruct() {
		$this->loga('', true);
	}
	
	public static function getName() {
		$s  = '';
		$s .= self::fnamePre	 . '_';
		$s .= get_current_user() . '_'; // this is returning CLI user in APache mode.  Very strage.  get_current_user() does say the script owner, but still
		$s .= PHP_SAPI; // so just add this to prevent confusion.
		$s .= self::fnameSfx;
		return $s;
	}
	
	public function log(string $msg) {
		if ($msg === 'first') { $this->loga(date('Y-m-d H:i:s'). ' - ' . PHP_SAPI . '', false); return; }
		else $this->loga($msg);
		
	}
	
	private function loga(string $msg, bool $nl = false) {
		if ($nl) $msg .= "\n";
		else     $msg .= '; ';
		file_put_contents(self::getName(), $msg, FILE_APPEND);
	}
	
	public static function get(int $lns = self::defaultDisplayLines) {
		$cmd = 'tail -n ' .  $lns . ' ' .  self::getName() . ' | tac';
		$t = shell_exec($cmd);
		return $t;
	}
	
}
	
	

