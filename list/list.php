<?php

require_once(__DIR__ . '/../srv/serverDB.php');
require_once('/opt/kwynn/isKwGoo.php');

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
		
		if ($msght = self::getMsg()) return ['msg' => $msght];
		$res = dao_msg::getPubList();
		
		$ht = '';
		$i = 0;
		foreach($res as $r) {
			$ht .= '<tr>';
			$ht .= '<td>';
			++$i;
			$ht .= "<a class='mref' href='listT.php?n=$i&pubid=$r[pubid]'>";
			// $ht .= $r['pubid'];
			// $ht .= "'>";
			$ht .= $i;
			$ht .= '</a>';
			$ht .= '</td>';
			$ht .= '<td>';
			$ht .= date('m/d/Y H:i:s', $r['up_ts']);
			$ht .= '</td>';
			$ht .= '<td  class="len">';
			$ht .= $r['len'];
			$ht .= '</td>';
			$ht .= '</tr>' . "\n";
		}
		return $ht;
	}
	
	private static function showSecretOrDie() {
		if (isKwGoo()) return TRUE;		
		if (file_exists('/var/kwynn/i_am_Kwynn_local_dev_2021_11')) return TRUE;
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
