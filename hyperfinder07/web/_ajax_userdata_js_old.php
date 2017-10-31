<?php

/**
 * Set a name/value pair with an URL like
 *  _ajax_userdata_js.php?op=set&userid=xyz&name=name&value=value
 * 
 * Get all name/value pairs in JSON with an URL like
 *  _ajax_userdata_js.php?userid=xyz
 * 
 * Delete all name/value pairs with an URL like
 *  _ajax_userdata_js.php?op=del&userid=xyz
 * 
 * Get a new userid with an URL like
 *  _ajax_userdata_js.php?op=newuserid
 * 
 * !! Never delete the file _last_userid.txt !! 
 * !! because new users would get the settings of existing users !! 
 *  ( That's why the file is stored in a special directory called _DO_NOT_DELETE )
 */

$USERID_FILE = "_DO_NOT_DELETE/_last_userid.txt";

$USERDATA_FILE_PREFIX = "_DO_NOT_DELETE/userdata_";

$userid = $_REQUEST["userid"];

$op = $_REQUEST["op"];
$name = $_REQUEST["name"];
$value = $_REQUEST["value"];

//print " userid=$userid, op=$op, name=$name, value=$value<br>";

function getNextId($USERID_FILE) {
	
	// 0. create a new file if none exists
	if (!file_exists($USERID_FILE)) {
		$fp = fopen($USERID_FILE, 'w');
		fputs($fp, "0");
	}
	
	// 1. read last userid
	$fp = fopen($USERID_FILE, 'r');
	$buffer = fgets($fp);
	$lastId = intval($buffer);
	
	// 2. inc userid
	$newId = $lastId + 1;
	
	// 3. store new userid
	$fp = fopen($USERID_FILE, 'w');	
	fputs($fp, $newId);

	fclose($fp);
	
	return $newId;
}

function getFileName() {
	global $USERDATA_FILE_PREFIX, $userid;
	return $USERDATA_FILE_PREFIX . $userid . ".txt";
}

function parseData($userid) {
	$data = array();
	
	$filename = getFileName();
	if (file_exists($filename)) {
		$lines = file(getFileName());
		foreach($lines as $line) {
			list($name, $value) = explode("=", $line);
			if (isset($name) && isset($value)) {
				$data[$name] = trim($value);
			}
		}	
	}
	
	return $data;
}

function writeData($userid, $data) {
	$filename = $filename = getFileName();
	$fp = fopen($filename, 'w');
	foreach($data as $name => $value) {
		fputs($fp, $name . "=" . $value . "\n");
	}
}

function eraseData($userid) {
	unlink(getFileName());
}

function execOp($op) {
	if ($op === "set") {
		$data = parseData($userid);
		$data[$name] = $value;
		writeData($userid, $data);
		
	} else if ($op === "setAll") {
		// TODO
	
	} else if ($op === "newuserid") {
		print "\"" . getNextId($USERID_FILE) . "\"";
	
	} else if ($op === "del") {
		eraseData($userid);
	
	} else {
		$separator = "";
		print "({";
		$data = parseData($userid);
		foreach($data as $name => $value) {
			print $separator . $name . ": \"" . addslashes($value) . "\"";
			$separator = ", ";
		}
		print "})";
	}
}

if (isset($op)) {
	execOp($op);
}

?>