<?php
/**
 * Contains functions to execute editor actions
 */

function editor_executeAction() {
	global $headline, $feedback;
	global $userid_, $cmdid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel;
	
	if (isset($_REQUEST["new"])) {
		editor_clearForm();
	} elseif (isset($_REQUEST["save"])) {
		$_feedback = editor_saveCommand($userid_, $cmdid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel);
	} elseif (isset($_REQUEST["delete"])) {
		$_feedback = deleteCommand($userid_, $cmdid);
		editor_clearForm();
	}

	if ($_feedback != null && sizeof(trim($_feedback)) > 0) {
		$feedback = "<p><font color=red><b>$_feedback</b></font></p>";
	}
}

/**
 * Clears the form data
 */
function editor_clearForm() {
	global $newcmd;
	global $cmdid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel;

	$newcmd = null;
	$cmdid = null;
	$cmd = "";
	$method = "GET";
	$url = "";
	$params = "";
	$suchbegriffe = "";
	$suchdienst = "";
	$beispiel = "";
}

/**
 * Saves a command if it's valid.
 * If it's invalid, the variable $reloadData is set to false to avoid
 * that the form is populated with the data stored in the database.
 */
function editor_saveCommand($userid, $cmdid, $cmd, $method, $url, $params,$suchbegriffe, $suchdienst, $beispiel) {
	global $cmdid, $newcmd, $reloadData;

	// 1. Validation

	if ($userid == "") {
		$reloadData = false;
		return "keine userid gesetzt.";
	}
	elseif ($cmd == null || trim($cmd) == '') {
		$reloadData = false;
		return "Das Kommando darf nicht leer sein.";
	}
	elseif ($cmdid == "" && existsCommand($userid, $cmd)) {
		$reloadData = false;
		return "Dieses Kommando ist bereits vergeben.";
	}
	elseif (!uniqueCommand($userid, $cmd, $cmdid)) {
		$reloadData = false;
		return "Dieses Kommando ist bereits vergeben.";
	}
	elseif (!strpos($url, ".")) {
		$reloadData = false;
		return "Die URL ist ungültig.";
	}

	// 2. If OK: Save command

	else {
		if ($url != null && !strpos($url, "://")) {
			$url = "http://" . $url;
		}
		if ($cmdid != null && sizeof(trim($cmdid)) > 0) {
			updateCommand($cmdid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel);
		} else {
			insertCommand($userid, $cmd, $method, $url, $params, $suchbegriffe, $suchdienst, $beispiel);
			editor_clearForm();
		}
	}
	$cmdid = null;
	$newcmd = null;
}