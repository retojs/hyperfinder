<?php
/** 
 * Reads user commands from the DB and makes them available for the file do.php 
 */

require_once("_db_cmd.php");
$result = getUserCommands($_COOKIE["hyperid"]);

for ($i = 0; $i < mysql_num_rows($result); $i++) {
	$cmd = mysql_result($result, $i, "cmd");
	$url = mysql_result($result, $i, "url");
	$method = mysql_result($result, $i, "method");
	
	// explode comma separated commands
	if (strpos($cmd, "/") > 0) {
		$cmd_ = explode("/", $cmd);
	} else {
		$cmd_ = array($cmd);
	}
	
	if (strtoupper($method) == "POST") {
		$params__ = mysql_result($result, $i, "params");
		
		if (strpos($params__, ",") < 0) {
			// Need to create an array by hand if there's only a single param
			$params_ = array($params__);
		} else {
			$params_ = explode(",", $params__);
		}
		
		$params = array();
		foreach ($params_ as $param_) {
			$param = explode("=", $param_);
			if (sizeof($param) == 2) {
				$params[trim($param[0])] = trim($param[1]);
			}
		}
		$cmds[trim($cmd_[0])] = createPostCmd(trim($url), trim($url), $params);
		
	} else {
		$cmds[trim($cmd_[0])] = createGetCmd(trim($url));
	}
	
	foreach($cmd_ as $cmd) {
		$cmds[trim($cmd)] = $cmds[trim($cmd_[0])];
	}
}
?>