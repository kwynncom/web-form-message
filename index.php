<!DOCTYPE html>
<html lang='en'>
<?php 
require_once(__DIR__ . '/getuid.php'); 
?>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>send a message</title>

<script src='js/utils.js'      ></script>
<script src='js/send.js'></script>
<script src='js/ioregulatedProgressMsgs.js'></script>
<script src='js/ioregulated.js'></script>
<script src='js/win_onload.js' ></script>

<style>
	#kwjsioResponseEle { min-width: 18ex; display: inline-block; }
	#msg { width: 93vw; height: 80vh; }
	.stad { margin-bottom: 0.2ex; }
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
</body>
</html>
