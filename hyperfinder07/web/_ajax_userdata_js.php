<?php
require_once("_db_userdata.php");

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
 */

$userid = $_REQUEST["userid"];
$op = $_REQUEST["op"];
$name = $_REQUEST["name"];
$value = $_REQUEST["value"];

//print " userid=$userid, op=$op, name=$name, value=$value<br>";

if ($op === "set") {
	$data = parseData($userid);
	$data[$name] = $value;
	eraseData($userid);
	writeData($userid, $data);
	
} else if ($op === "setAll") {
	// TODO

} else if ($op === "newuserid") {
	print "\"" . getNextId() . "\"";

} else if ($op === "del") {
	eraseData($userid);

} else if ($userid != null && trim($userid) != "") {
	$separator = "";
	print "({";
	$data = parseData($userid);
	foreach($data as $name => $value) {
		print $separator . $name . ": \"" . addslashes($value) . "\"";
		$separator = ", ";
	}
	print "})";
}

?>