<?php

session_start();

if (isset($_REQUEST["getForward"])) {
	$key = $_REQUEST["key"];
	$_SESSION["key"] = $key;
} else {
	$key = $_SESSION["key"];
}

$forward = $_REQUEST["forward"];
$content = "http://" . $forward;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<script type="text/javascript" src="../js/ctrl.js"></script>
<title>IPhone Remote</title>
</head>
<body onload="setPollTimeout()" style="margin: 0px; background-image: url(../img/b.png); background-repeat: repeat-x">

<form action="listener.php" method="POST"><label>&nbsp;Key:</label><input type="text" name="key"
	value="<?php if (isset($key)) print $key;?>" />
<button type="submit" name="getForward">Set as Listener</button>
</form>

<iframe src="<?php print $content;?>" width="100%" height="900px"></iframe>

</body>
</html>
