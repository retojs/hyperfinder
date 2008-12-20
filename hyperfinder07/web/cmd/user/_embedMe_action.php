<?php
/**
 * Contains functions to execute email actions:
 *
 *   op = embedMe:
 * 				public Kommando installieren.
 *
 */

function embedMe_executeAction($userid) {
	global $headline, $feedback, $commandSet;

	if ($_GET["op"] == "embedMe") {
		$id = $_REQUEST["id"];
		$code = $_REQUEST["code"];

		$headline = "Kommando installieren";
		$feedback = importPublicCommand($id, $code);
		
	}
}

function importPublicCommand($cmdid, $code) {
	global $commandSet;
	$result = getCommand($cmdid);
	if (1 != mysql_num_rows($result) || $code != mysql_result($result, 0, "code")) { return "Code ungültig. Installation fehlgeschlagen."; }
	
	$userid = $_COOKIE['userid'];
	$cmd = mysql_result($result, 0, "cmd");
	$method = mysql_result($result, 0, "method");
	$url = mysql_result($result, 0, "url");
	$params = mysql_result($result, 0, "params");
	$suchbegriffe = mysql_result($result, 0, "suchbegriffe");
	$suchdienst = mysql_result($result, 0, "suchdienst");
	$beispiel = mysql_result($result, 0, "beispiel");
	
	insertCommand($userid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel);
	$commandSet = "($cmdid)";
	return "Kommando <i>$cmd</i> erfolgreich installiert.";
}
?>

