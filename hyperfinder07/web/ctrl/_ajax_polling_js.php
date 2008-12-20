<?php

session_start();

include("../_db.php");
openDB();

function getForward($key) {
	if (!isset($key) || trim($key) == "") {
		return false;
	}
	$result = execQuery("SELECT forward FROM ctrl_links WHERE linkK = '$key'");
	if (isset($result) && mysql_numrows($result) > 0) {
		return mysql_result($result, 0, "forward");
	}
}

$key = $_SESSION["key"];
$forward = getForward($key);
print "({";
if ($_SESSION["forward"] != $forward) {
	$_SESSION["forward"] = $forward;
	print "'url':'$forward', 'key':'$key'";
}
print "})";
?>