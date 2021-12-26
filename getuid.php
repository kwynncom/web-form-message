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

if (didCLICallMe(__FILE__)) echo(uoids() . "\n");