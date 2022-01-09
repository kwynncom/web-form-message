<!DOCTYPE html>
<html lang='en'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>title</title>

<style>
    body { font-family: sans-serif; }
	.mref { font-size: 120%; }
	td.len { padding-left: 1.5ex; text-align: right; }
	.sbp { margin-top: 3ex; margin-left: 8ex; }
	button { font-size: 150%; }
</style>
</head>
<body>
<?php
	require_once('list.php');
	$r10 = msg_public_list::getHT();
	if (is_string($r10)) {
?>
	<p>The messages are not public.  The links only work for me.
		<a href='../'>new msg</a>
		<a href='/'>home</a>
	</p>

	<table>
		<tr><th></th><th></th><th>len</th></tr>
<?php echo($r10); ?>
	</table>
<?php if ($G_KW_IKGOO) { ?>
	<div class='sbp'>
		<button>seen</button>
	</div>
	<?php } unset($G_KW_IKGOO );
	}
	if (is_array($r10)) {  ?>
	<div>
		<p>back to <a href='./listTP.php'>list</a></p>
		<div>
		<?php echo($r10['msg']); ?>
		</div>
	</div>
<?php } ?>
</body>
</html>
