<!DOCTYPE html>
<html lang='en'>
<?php 
require_once(__DIR__ . '/config.php'); 
?>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>send a message</title>

<script src='js/buttons.js'></script>
<script src='/opt/kwynn/js/utils.js'      ></script>
<script src='js/gen/ioregulatedProgressMsgs.js'></script>
<script src='js/gen/ioregulated.js'></script>
<script src='js/gen/notify.js'></script>
<script src='js/win_onload.js' ></script>

<style>
	body { font-family: sans-serif; }
	#kwjsioResponseEle { min-width: 18ex; display: inline-block; }
	#msg { width: 93vw; height: 80vh; }
	.stad { margin-bottom: 0.2ex; }
	button { margin-top: 1.5ex; font-size: 120%; display: inline-block; margin-right: 2ex; }
	.lista { margin-right: 2ex; }
</style>

</head>
<body>
	<div class='stad'>
		<span id='kwjsioResponseEle'></span>
		<span id='savedCh'>0</span>
		/ <span><?php echo(KW_MSG_2021_1226_1_MAXLEN); ?> saved</span>
	</div>
	<div>
		<input id='pageid' type='hidden' value='<?php echo(dao_generic_3::get_oids(TRUE)); ?>' />
		<textarea			id='msg' ></textarea>
	</div>
	<div>
		<button class='dbtn' onclick='onmsgDone();'>done</button>
		<button onclick='new onnew();'>new</button>
		<a class='lista' href='./list/listTP.php'>msg list</a>
		<a href='/t/22/01/msg22/more.html'>more</a>
	</div>
</body>
</html>
