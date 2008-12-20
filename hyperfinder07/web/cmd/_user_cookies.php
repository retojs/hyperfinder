<?php
require_once("../_db_userdata.php");
/** 
 * Generate new userid and userpwd if cookie or DB-entry is missing  
 */ 
$userid = $_COOKIE["userid"];
$userpwd = $_COOKIE["userpwd"];
if (!existsUser($userid) || $userid == null || $userid == "" || $userpwd == null || $userpwd == "") {
	$userid = getNextId();
	$userpwd = createCode(64);
	storeUserPwd($userid, $userpwd);
}
// renew cookie each time
setcookie("userid", $userid, time() + 90*24*60*60);
setcookie("userpwd", $userpwd, time() + 90*24*60*60);
?>