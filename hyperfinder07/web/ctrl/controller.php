<?php

include("../_db.php");
openDB();

function existsForward($key) {
	if (!isset($key) || trim($key) == "") {
		return false;
	}
	$result = execQuery("SELECT * FROM ctrl_links WHERE linkK = '$key'");
	if (isset($result)) {
		return mysql_num_rows($result) > 0;
	}
}

function getForward($key) {
	if (!isset($key) || trim($key) == "") {
		return false;
	}
	$result = execQuery("SELECT forward FROM ctrl_links WHERE linkK = '$key'");
	if (isset($result) && mysql_numrows($result) > 0) {
		return mysql_result($result, 0, "forward");
	}
}

if (isset($_REQUEST["setForward"])) {
	$key = $_REQUEST["key"];
	$forward = $_REQUEST["forward"];

	if (isset($key) && isset($forward) && trim($key) != "" && trim($forward) != "") {
		if (existsForward($key)) {
			execQuery("UPDATE ctrl_links SET forward = '$forward' WHERE linkK = '$key'");
		} else {
			execQuery("INSERT INTO ctrl_links SET linkK = '$key', forward = '$forward'");
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>IPhone Remote</title>
</head>
<body>
<h3>Browser Controller</h3>

<form action="controller.php" method="POST"><label>KEY:</label> <input type="text" name="key"
	value="<?php if (isset($key)) { print $key;}?>" /> <br />
<label>URL: http://</label> <input type="text" style="width: 400px" name="forward"
	value="<?php if (isset($forward)) print $forward; ?>" />
<button type="submit" name="setForward">Go!</button>

<div>forward set to: <?php print "http://" . getForward($key); ?></div>
</form>

</body>
</html>
