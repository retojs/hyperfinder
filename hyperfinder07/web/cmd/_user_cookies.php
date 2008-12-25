<?php
require_once("../_db_userdata.php");
/** 
 * Generate new userid and userpwd if cookie or DB-entry is missing  
 */ 
$userid_ = $_COOKIE["userid"];
$userpwd_ = $_COOKIE["userpwd"];
if (!existsUser($userid_) || $userid_ == null || $userid_ == "" || $userpwd_ == null || $userpwd_ == "") {
	$userid_ = getNextId();
	$userpwd_ = createCode(64);
	storeUserPwd($userid_, $userpwd_);
}
// renew cookie each time
setcookie("userid", $userid_, time() + 90*24*60*60);
setcookie("userpwd", $userpwd_, time() + 90*24*60*60);
?>