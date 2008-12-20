<?php
require_once("_db.php");

function getNextId() {
	$result = execQuery("SELECT max(userid) as userid FROM userdata");
	if (mysql_num_rows($result) > 0) {
		return mysql_result($result, 0, "userid") + 1;
	} else {
		return 1;
	}
}

function parseData($userid) {
	$result = execQuery("SELECT name, value FROM userdata WHERE userid = '$userid'");
	$data = array();
	for ($i = 0 ; $i < mysql_num_rows($result); $i++) {
		$name = mysql_result($result, $i, "name");
		$value = mysql_result($result, $i, "value");
		$data[trim($name)] = trim($value);
	}
	return $data;
}

function insertData($userid, $name, $value) {
	execQuery("INSERT INTO userdata SET name = '$name', value = '$value', userid = '$userid'");
}

function writeData($userid, $data) {
	foreach($data as $name => $value) {
		insertData($userid, $name, $value);
	}
}

function eraseData($userid) {
	execQuery("DELETE FROM userdata WHERE userid = '$userid'");
}

?>