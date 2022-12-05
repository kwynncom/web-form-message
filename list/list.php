<?php

require_once(__DIR__ . '/../srv/serverDB.php');

class msg_public_list {
	public static function getHT() { 
		$o = new self();
		return $o->getHTI();
	}
	private function __construct() { 
		$this->oht = $this->do10();
	}
	public function getHTI() { return $this->oht; }
	private function do10() {
		
		global $G_KW_IKGOO;
		$ism = $G_KW_IKGOO;
		
		if ($msght = self::getMsg()) return ['msg' => $msght];
		$res = dao_msg::getPubList();
		
		$ht = '';
		
		$i = 0;
		if ($res) $i = count($res);
			
		foreach($res as $r) {
			$ht .= "<tr data-pubid='$r[pubid]'>";
			$ht .= '<td class="tar snum">';
			if ($ism) $ht .= "<a class='mref' href='listTP.php?n=$i&pubid=$r[pubid]'>";
			$ht .= $i--;
			if ($ism) $ht .= '</a>';
			$ht .= '</td>';
			$ht .= '<td>';
			$ht .= date('m/d H:i:s', $r['cre_ts']);
			$ht .= '</td>';
			$ht .= '<td  class="len">';
			$ht .= $r['len'];
			$ht .= '</td>';
			$ht .= '</tr>' . "\n";
		}
		return $ht;
	}
	
	private static function showSecretOrDie() {
		if (isMyCookie() === TRUE) return TRUE;
		die('not-auth-ssod-msgs');
	}
	
	public static function getMsg() {
		if (!($pubidraw = isrv('pubid'))) return FALSE;
		$pubid = dao_generic_3::oidsvd($pubidraw); unset($pubidraw);
		self::showSecretOrDie();
		
		$msga = dao_msg::getMsg($pubid);
		$msgraw = $msga['v'];
		
		$ht  = '';

		$ht .= '<p>';		
		if (($n = isrv('n')) && is_numeric($n)) $ht .= "# $n: ";
		$ht .= date('m/d/Y H:i:s', $msga['up_ts']);	
		$ht .= ", $msga[len] chars";
		$ht .= '</p>';		
		
		$ht .= '<pre>' . "\n";
		$htesc  = $ht . htmlspecialchars($msgraw) . "\n"; unset($ht);
		$htesc .= '</pre>' . "\n";

		return $htesc;
	}
}

if (didCLICallMe(__FILE__)) msg_public_list::get();
