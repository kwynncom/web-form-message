<!DOCTYPE html>
<html lang='en'>
<?php 
	require_once(__DIR__ . '/getuid.php'); 
	require_once(__DIR__ . '/config.php');
?>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>send a message</title>

<script src='utils.js'      ></script>
<script src='send.js'></script>
<script src='ioregulatedProgressMsgs.js'></script>
<script src='ioregulated.js'></script>
<script src='win_onload.js' ></script>

<style>
	#kwjsioResponseEle { min-width: 25ex; display: inline-block; }
</style>

</head>
<body>
	<div>
		Statuts: <span id='kwjsioResponseEle'></span>
		<span id='savedCh'>0</span>
		/ <span><?php echo(KW_MSG_2021_1226_1_MAXLEN); ?> allowed characters saved</span>
	</div>
	<div>
		<input id='pageid' type='hidden' value='<?php echo(uoids()); ?>' />
		<textarea			id='msg' ></textarea>
	</div>
</body>
</html>
