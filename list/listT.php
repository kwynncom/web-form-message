<!DOCTYPE html>
<html lang='en'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>title</title>

<style>
    body { font-family: sans-serif; }
	.mref { font-size: 120%; }
	td.len { padding-left: 1.5ex; }
</style>
</head>
<body>
<?php
	require_once('list.php');
	$r10 = msg_public_list::getHT();
	if (is_string($r10)) {
?>
	<p>The messages are not public.  The links only work for me.
		
	</p>

	<table>
		<tr><th></th><th></th><th>len</th></tr>
<?php echo($r10); ?>
	</table>
<?php 
	}
	if (is_array($r10)) {  ?>
	<div>
		<?php echo($r10['msg']); ?>
	</div>
<?php } ?>
</body>
</html>
