<!DOCTYPE html>
<html lang='en'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'    />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />

<title>title</title>

<style>
    body { font-family: sans-serif; }
</style>
</head>
<body>
	<p><a href='../more.html'>more</a></p>
	<?php require_once(__DIR__ . '/log.php'); 	?>
	<pre><?php echo(webFormMsgLog::get()); ?></pre>
</body>
</html>
