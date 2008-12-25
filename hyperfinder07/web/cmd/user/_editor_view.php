<?php

require_once("_editor_view_row.php");

function editor_printCommandTable($userid) {
	global $cmdid, $cmd, $url, $suchbegriffe, $suchdienst, $beispiel;
	global $newcmd, $reloadData;
	global $BASE_URL;
	
	$result = getUserCommands($userid);
	print "<table>";
	print "<input type=\"hidden\" name=\"nofCmds\" value=\"" . mysql_num_rows($result) . "\" />";
	
	$newButton = (!isset($newcmd) || $newcmd == null);
	editor_printHeader($newButton);
	
	if (!$newButton) {
		editor_printRowEdit($cmdid, $newcmd, $cmd, $url, $suchbegriffe, $suchdienst, $beispiel, $method, $params, $constants);
	}

	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$_cmd = mysql_result($result, $i, "cmd");
		$_suchbegriffe = mysql_result($result, $i, "suchbegriffe");
		$_suchdienst = mysql_result($result, $i, "suchdienst");
		$_beispiel = mysql_result($result, $i, "beispiel");
		$_method = mysql_result($result, $i, "method");
		$_params = mysql_result($result, $i, "params");
		if (trim($method) == "") {
			$method = "GET";
		}

		$_id = mysql_result($result, $i, "id");

		if ($_id == $cmdid) {
			if ($reloadData == true) {

				$url = mysql_result($result, $i, "url");

				$cmd = $_cmd;
				$suchbegriffe = $_suchbegriffe;
				$suchdienst = $_suchdienst;
				$beispiel = $_beispiel;
				$method = $_method;
				$params = $_params;
			}
			editor_printRowEdit($cmdid, $newcmd, $cmd, $url, $suchbegriffe, $suchdienst, $beispiel, $method, $params);
		} else {
			$editOnClick = "document.location.href='" . $BASE_URL . "cmdid=" . $_id . "'";
			editor_printRow($i, $_id, $_cmd, $_suchbegriffe, $_suchdienst, $_beispiel, $editOnClick);
		}
	}
	print "</table>";
}

function editor_printSelectedCommands($commandSet) {
	if ($commandSet == "") { return; }
	
	$result = getCommands($commandSet);
	if($result == null) { return; }
	
	print "<table class=\"selectedCommands\">";
	print "<input type=\"hidden\" name=\"nofCmds\" value=\"" . mysql_num_rows($result) . "\" />";
	editor_printHeader();
	
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$_cmd = mysql_result($result, $i, "cmd");
		$_suchbegriffe = mysql_result($result, $i, "suchbegriffe");
		$_suchdienst = mysql_result($result, $i, "suchdienst");
		$_beispiel = mysql_result($result, $i, "beispiel");
		
		editor_printRowSelected($_cmd, $_suchbegriffe, $_suchdienst, $_beispiel);
	}
	print "</table>";
}

function editor_printEmbedMeCommands($userid) {
	
	$result = getUserCommands($userid);

	print "<table>";
	print "<input type=\"hidden\" name=\"nofCmds\" value=\"" . mysql_num_rows($result) . "\" />";
	editor_printHeader();
	
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$_id = mysql_result($result, $i, "id");
		$_cmd = mysql_result($result, $i, "cmd");
		$_suchbegriffe = mysql_result($result, $i, "suchbegriffe");
		$_suchdienst = mysql_result($result, $i, "suchdienst");
		$_beispiel = mysql_result($result, $i, "beispiel");
		$_code = mysql_result($result, $i, "code");
		
		editor_printRowEmbedMe($i, $_id, $_cmd, $_suchbegriffe, $_suchdienst, $_beispiel, $_code);
	}
	print "</table>";
}
?>
