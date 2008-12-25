<?php

if (strtolower($_SERVER["HTTP_HOST"]) == 'localhost') {
	$HOST = "localhost";
	$LOGIN = "root";
	$PWD = "filmguerilla";
	$DB_NAME = "hyperfinder";
} else {
	$HOST = "localhost";
	$LOGIN = "web225";
	$PWD = "svenska";
	$DB_NAME = "usr_web225_2";
}

// opens database connection and return the $link
function openDB() {
	global $HOST, $LOGIN, $PWD, $DB_NAME;

	$link = mysql_connect($HOST, $LOGIN, $PWD);
	if (!$link) {
		die("Couldn't connect to MySQL");
	}
	mysql_select_db($DB_NAME) or die($DB_NAME);
	return $link;
}

$db_link = openDB();

//
// Functions

// Set this to true for detailed output
$DEBUG_SQL = false;

function execQuery($q) {
	global $DEBUG_SQL;

	if ($DEBUG_SQL) {
		echo "<p>" . $q . "</p>";
	}
	$result = mysql_query($q);
	if (!$result) {
		print mysql_error();
	}
	return $result;
}

function existsUser($userid) {
	$result = execQuery("SELECT id FROM userpwd WHERE userid = '$userid'");
	return mysql_num_rows($result) > 0;
}

/** Associates the specified userid with the specified 64-character userpwd. */
function storeUserPwd($userid, $userpwd) {
	execQuery("DELETE FROM userpwd WHERE userid = '$userid'");
	execQuery("INSERT INTO userpwd SET userid = '$userid', userpwd = '$userpwd'");
}

/** Returns true, if the specified userid and userpwd match the values in the DB-table userpwd. */
function isUserPwdMismatch($userid, $userpwd) {
	$result = execQuery("SELECT id FROM userpwd WHERE userid = '$userid' AND userpwd = '$userpwd'");
	return (mysql_num_rows($result) == 0);
}

/** Returns true, if the specified userid and userpwd match the values in the DB-table userpwd. */
function authenticate($userid, $userpwd) {
	$result = execQuery("SELECT id FROM userpwd WHERE userid = '$userid' AND userpwd = '$userpwd'");
	if (mysql_num_rows($result) == 1) {
		return true;
	} else {
		print "Permission denied (userid='$userid', userpwd='$userpwd')";
		die();
	}
}

/** Generates a random code */
function createCode($length) {
	$code = "";
	for ($j = 0; $j < $length; $j++) {
		$code .= randomChar();
	}
	return $code;
}

/** Generates a random char [0-1][a-z][A-Z] */
function randomChar() {
	
	// for ASCII char numbers see: http://www.asciitable.com 	
	$charOffset['number'] = 48;
	$charOffset['letterUp'] = 65;
	$charOffset['letterLo'] = 97;
	
	$n = rand(0, 10 + 26 + 26);
	
	if (0 <= $n && $n < 10) {
		return chr($charOffset['number'] + $n);
	} else if (10 <= $n && $n < 10 + 26) {
		return chr($charOffset['letterUp'] + ($n - 10));
	} else if (10 + 26 <= $n && $n < 10 + 26 + 26) {
		return chr($charOffset['letterLo'] + ($n - 10 - 26));
	} else { 
		return "_"; 
	}
}

?>