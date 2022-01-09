<?php

require_once('/opt/kwynn/kwutils.php');
require_once('/opt/kwynn/isKwGoo.php');

define('KW_MSG_2021_1226_1_MAXLEN', 20000);

function isMyCookie($orDie = false) {
	return gooOrDev($orDie) && 1;
}