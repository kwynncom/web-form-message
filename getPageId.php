<?php

require_once('/opt/kwynn/kwutils.php');

function uoids($tec = false) {
	$o   = new MongoDB\BSON\ObjectId();
	$s   = $o->__toString();
	if ($tec) echo($s . "\n");
	$ts  = $o->getTimestamp();
	$tss = date('md-Hi-Y-s', $ts);
	$fs  = $tss . '-' .  substr($s  ,  8);
	if ($tec) echo($fs . "\n");
	return $fs;
}

if (didCLICallMe(__FILE__)) uoids(1);