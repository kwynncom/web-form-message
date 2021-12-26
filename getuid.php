<?php

require_once('/opt/kwynn/kwutils.php');

function uoids() {
	$o   = new MongoDB\BSON\ObjectId();
	$s   = $o->__toString();
	$ts  = $o->getTimestamp(); unset($o);
	$tss = date('md-Hi-Y-s', $ts); unset($ts);
	$fs  = $tss . 's-' .  substr($s  ,  8) . '-' . base62(15); unset($tss, $s);
	return $fs;
}

function uoids_is_valid($sin) {
	kwas(is_string($sin), 'bad id - 1 - 234');
	kwas(preg_match('/^[\w-]{51}$/', $sin, $ms), 'bad id');
	return $ms[0];
}

if (didCLICallMe(__FILE__)) echo(uoids() . "\n");