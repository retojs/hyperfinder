<?php
require_once("../_db_userdata.php");
/** 
 * Generate new userid and userpwd if cookie or DB-entry is missing  
 */ 
$userid_ = $_COOKIE["userid"];
$userpwd_ = $_COOKIE["userpwd"];
// Falls userid und userpwd nicht zusammenpassen wird eine neue userid generiert.
// Grund: Es kann aus nicht gekl�rten Gr�nden vorkommen, dass userid und userpwd nicht zusammenpassen.
//        Falls in diesem Fall einfach eine neue userid zugewiesen wird, l�sst sich der account aber nicht hacken.
if (isUserPwdMismatch($userid_, $userpwd_) || !existsUser($userid_) || $userid_ == null || $userid_ == "" || $userpwd_ == null || $userpwd_ == "" ) {
	$userid_ = getNextId();
	$userpwd_ = createCode(64);
	storeUserPwd($userid_, $userpwd_);
}
// renew cookie each time
setcookie("userid", $userid_, time() + 90*24*60*60);
setcookie("userpwd", $userpwd_, time() + 90*24*60*60);
?>  