<?php

require_once('/opt/kwynn/kwutils.php');
require_once(__DIR__ . '/serverDB.php');
require_once(__DIR__ . '/../notify.php');

receive();

function receive() {

	static $rkey = 'POSTob';

	try {
		kwas($_REQUEST[$rkey], "$rkey not found in POST/GET/REQUEST - receive() jsio test");
		$r = $_REQUEST[$rkey];
		$a = json_decode($r, true); kwas($a, "$rkey not json_decoded - receive() jsio test"); unset($r, $rkey);
	} catch(Exception $ex) {
		http_response_code(400); // 400 === bad request
		throw $ex;
	}

	if (isset($a['action']) && 
			  $a['action'] === 'getpageid') { 
		$rid = dao_generic_3::get_oids(TRUE);
		$pidr['pageidact'] = 'OK';
		$pidr['pageid'] = $rid;
		kwjae($pidr);

	}

	if (($aa = kwifse($a, 'a')) && kwifse($a, 'type') && $a['type'] === 'seen') {
		kwas(isMyCookie(TRUE), 'just a double check for truth');
		$o = new notify_email_msgs($aa);
		kwjae($o->matmod);
	}
 
	
	$dbr = 'you should not get this response - receive() jsio ex';
	try {
		$dao = new dao_msg();
		$dbr = $dao->putMsgOrDie($a);
	} catch(Exception $ex) {
		http_response_code(500); // 500 === interval server error
		throw $ex;
	}

	kwjae($dbr);
		
}
