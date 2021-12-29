<?php

require_once('/opt/kwynn/kwutils.php');
require_once(__DIR__ . '/serverDB.php');

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
	
	$dbr = 'you should not get this response - receive() jsio ex';
	try {
		$dao = new dao_msg();
		$dbr = $dao->putOrDie($a);
	} catch(Exception $ex) {
		http_response_code(500); // 500 === interval server error
		throw $ex;
	}

	kwjae($dbr);
		
}
