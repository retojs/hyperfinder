<?php
require_once("../_db_userdata.php");
/** 
 * Generate new userid and userpwd if cookie or DB-entry is missing  
 */ 
$userid_ = $_COOKIE["hyperid"];
$userpwd_ = $_COOKIE["hyperpwd"];
// Falls userid und userpwd nicht zusammenpassen wird eine neue userid generiert.
// Grund: Es kann aus nicht geklärten Gründen vorkommen, dass userid und userpwd nicht zusammenpassen.
//        Falls in diesem Fall einfach eine neue userid zugewiesen wird, lässt sich der account aber nicht hacken.
if (isUserPwdMismatch($userid_, $userpwd_) || !existsUser($userid_) || $userid_ == null || $userid_ == "" || $userpwd_ == null || $userpwd_ == "" ) {
	$userid_ = getNextId();
	$userpwd_ = createCode(64);
	storeUserPwd($userid_, $userpwd_);
	$_COOKIE["hyperid"] = $userid_;
	$_COOKIE["hyperpwd"] = $userpwd_;
}
// renew cookie each time
setcookie("hyperid", $userid_, time() + 90*24*60*60, "/");
setcookie("hyperpwd", $userpwd_, time() + 90*24*60*60, "/");
?>     