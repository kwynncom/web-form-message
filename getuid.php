<?php

require_once('/opt/kwynn/kwutils.php');

define('KW_MSG_2021_1226_1_MAXLEN', 20000);

function uoids($rand = true) {
	$o   = new MongoDB\BSON\ObjectId();
	$s   = $o->__toString();
	$ts  = $o->getTimestamp(); unset($o);
	$tss = date('md-Hi-Y-s', $ts); unset($ts);
	$fs  = $tss . 's-' .  substr($s  ,  8);
	if ($rand) 
	$fs .= '-' . base62(15); unset($tss, $s, $rand);
	return $fs;
}

function uoids_is_valid($sin) {
	kwas(is_string($sin), 'bad id - 1 - 234');
	kwas(preg_match('/^[\w-]{35,51}$/', $sin, $ms), 'bad id');
	return $ms[0];
}

if (didCLICallMe(__FILE__)) echo(uoids() . "\n");