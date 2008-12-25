<?php

session_start();

if (isset($_REQUEST["key"])) {
	$_SESSION["key"] = $_REQUEST["key"];
}
$key = $_SESSION["key"];

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