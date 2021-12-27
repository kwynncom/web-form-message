<!DOCTYPE html>
<html lang='en'>
<?php 
require_once(__DIR__ . '/getuid.php'); 
?>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>send a message</title>

<script src='js/buttons.js'></script>
<script src='js/gen/utils.js'      ></script>
<script src='js/gen/send.js'></script>
<script src='js/gen/ioregulatedProgressMsgs.js'></script>
<script src='js/gen/ioregulated.js'></script>
<script src='js/win_onload.js' ></script>

<style>
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
		<input id='pageid' type='hidden' value='<?php echo(uoids()); ?>' />
		<textarea			id='msg' ></textarea>
	</div>
	<div>
		<button class='dbtn' onclick='onmsgDone();'>Done</button>
		<a class='lista' href='./list/listT.php'>msg list</a>
		<button onclick='new onnew();'>new</button>
	</div>
</body>
</html>
