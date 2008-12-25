<?php
require_once("../_db.php");

function getCommand($cmdid) {
	return execQuery("SELECT * FROM commands WHERE id = '$cmdid'");
}

/**
 * Lädt Kommandos zu einer userid.
 * Falls der userid eine emailaddr zugeordnet ist, werden auch die Kommandos für all jene userids geladen
 * die mit dieser emailaddr sonst noch assoziiert sind.
 */
function getUserCommands($userid) {
	$emailaddr = existsEmail($userid);
	if (!$emailaddr) {
		return execQuery("SELECT * FROM commands WHERE userid = '$userid' ORDER BY cmd");
	} else {
		$q = "SELECT * FROM commands c, emailaddrs e";
		$q .= " WHERE e.emailaddr = '$emailaddr' ";
		$q .= " AND e.userid = c.userid ";
		$q .= " AND e.confirmcode = 'ok' ";
		$q .= " ORDER BY cmd";
		return execQuery($q);
	}
}

function getCommands($commandSet) {
	if ($commandSet == null || $commandSet == "") {return null;}
	return execQuery("SELECT * FROM commands WHERE id in ($commandSet)");
}

function existsCommand($userid, $cmd) {
	$result = execQuery("SELECT * FROM commands WHERE userid = '$userid' AND cmd = '$cmd'");
	return (mysql_num_rows($result) > 0);
}

function existsEmail($userid) {
	$result = execQuery("SELECT * FROM emailaddrs WHERE userid = '$userid' AND confirmcode = 'ok'");
	if (mysql_num_rows($result) > 0) {
		return  mysql_result($result, $i, "emailaddr");
	} else {
		return false;
	}
}

function uniqueCommand($userid, $cmd, $cmdid) {
	$result = execQuery("SELECT * FROM commands WHERE userid = '$userid' AND cmd = '$cmd'");
	if (mysql_num_rows($result) > 0) {
		$id = mysql_result($result, $i, "id");
		if ($cmdid != $id) {
			return false;
		}
	}
	return true;
}

function insertCommand($userid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel) {
	global $userid_, $userpwd_;
	authenticate($userid_, $userpwd_);

	$code = createCode(32);
	$q = "INSERT INTO commands";
	$q .= " SET userid = '$userid', cmd='$cmd', code='$code', method='$method', url='$url', params='$params', suchbegriffe='$suchbegriffe', suchdienst='$suchdienst', beispiel='$beispiel'";
	execQuery($q);
}

function updateCommand($cmdid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel) {
	global $userid_, $userpwd_;
	authenticate($userid_, $userpwd_);
	
	$q = "UPDATE commands";
	$q .= " SET cmd='$cmd', method='$method', url='$url', params='$params', suchbegriffe='$suchbegriffe', suchdienst='$suchdienst', beispiel='$beispiel'";
	$q .= " WHERE id = '$cmdid'";
	execQuery($q);
}

function deleteCommand($userid, $cmdid) {
	global $userid_, $userpwd_;
	authenticate($userid_, $userpwd_);
	
	execQuery("DELETE FROM commands WHERE id = '$cmdid'");
}

/** Copy the specified commands to a new userid */
function shareCommands($commandSet, $newUserId) {
	global $userid_, $userpwd_;
	authenticate($userid_, $userpwd_);
	
	if (sizeof(trim($commandSet)) == 0) return false;
	$q = "INSERT INTO commands (userid, cmd, code, method, url, params, suchbegriffe, suchdienst, beispiel)";
	$q .= " SELECT 'share_$newUserId', cmd, code, method, url, params, suchbegriffe, suchdienst, beispiel";
	$q .= " FROM commands WHERE id IN ($commandSet)";
	execQuery($q);
	return mysql_affected_rows();
}

function getAcceptCommandSet($tempUserId) {
	$q = "SELECT id FROM commands WHERE userid = 'share_$tempUserId'";
	return execQuery($q);
}

/** Copy the specified commands to a new userid */
function acceptCommands($cookieUserId, $tempUserId) {
	$q = "UPDATE commands SET userid = '$cookieUserId' WHERE userid = 'share_$tempUserId'";
	execQuery($q);
	return mysql_affected_rows();
}
?>