<!DOCTYPE html>
<html lang='en'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>title</title>

<style>
    body { font-family: sans-serif; }
</style>
</head>
<body>
	<table>
		<?php
			require_once('list.php');
			$r10 = msg_public_list::getHT();
			if (is_string($r10)) echo($r10);
		?>
	</table>
	<div>
<?php if (is_array($r10)) echo($r10['msg']); ?>
	</div>
</body>
</html>
