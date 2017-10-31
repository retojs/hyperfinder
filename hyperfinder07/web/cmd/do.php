<?php

/**
 * Diese Klasse führt eine Kommandozeilen-Suchanfrage aus.
 * Dazu benutzt sie die PHP-Klasse Command (definiert in Commnd.php).
 *
 * In der Datei _urls.php werden die beiden arrays $cmds und $link definiert.
 * Diese beiden assoziativen Arrays enthalten die URLs für die Suchanfragen.
 * Dabei ist der array-key jeweils das Kürzel.
 * Die Suchparameter in den URLs sind arg0, arg1, arg2 etc. benannt.
 * Diese werden jeweils mit den Parameter-Werten der konkreten Suchanfrage ersetzt.
 * Falls ein Suchdienst eine spezielle URL für PDAs bereitstellt, kann diese in _urls_pda.php definert werden.
 *
 * Ausgeführt wird eine Anfrag über die methode execRequest der Klasse Command.
 * Vorher werden ev. default Parameter-Werte gesetzt in der funktion addDefaults (siehe unten).
 *
 */

require_once ("Command.php");

require_once ("_urls.php");
if (trim($_REQUEST["pda"]) == "y") {
	require_once ("_urls_pda.php");
}

/////
// Special default settings

function addDefaults($params, $cmdName) {
	if ($cmdName =="sbb" || $cmdName =="tram" ||$cmdName =="bus" ||$cmdName =="öv") {
		// 1. default date: heute
		if (sizeof($params) == 2) {
			$params[2]= date("d.m.Y");
		}
		// 2. falls nur Zeit angegeben ist: default date heute setzen
		if (sizeof($params) == 3) {
			// prüfen, ob es sich bei param[2] um ein datum handelt
			$p2 = trim($params[2]);
			$lastword = trim(substr($p2, strrpos($p2, " ")));
			$endswithAnAb = strtolower($lastword) == "an" || strtolower($lastword) == "ab";
			$hasColon = strpos($p2, ":") > 0;
			$strlen3 = strlen($p2) == 3;
			$strlen4 = strlen($p2) == 4;
			if ($endswithAnAb || $hasColon || $strlen3 || $strlen4) {
				$params[3]= $params[2];
				$params[2]= date("d.m.Y");
			} else {
				$params[3]= date("H:i");
			}
		}
		// "ab" und "an" können am schluss der zeitangabe stehen (z.B. 1200 ab)
		if (isset($params[3]) && strpos(trim($params[3]), " ") > 0) {
			$p3 = trim($params[3]);
			$lastword = trim(substr($p3, strrpos($p3, " ")));
			if (strtolower($lastword) == "an") {
				$params[4] = 0;
			} else if (strtolower($lastword) == "ab") {
				$params[4] = 1;
			}
		}

	} else if ($cmdName =="geld" || $cmdName =="kurs" ||$cmdName =="wechselkurs") {
		// 1. Kommas gehen hier oft vergessen...
		if (sizeof($params) < 3) {
			$newparams = array();
			foreach($params as $paramList) {
				$list = explode(' ', $paramList);
				foreach ($list as $p) {
					if (strlen(trim($p)) > 0) {
						$newparams[] = $p;
					}
				}
			}
			$params = $newparams;
		}
		// 2. Gross-Kleinschreibung soll keine Rolle spielen
		$newparams = array();
		foreach($params as $p) {
			$newparams[] = strtoupper($p);
		}
		$params = $newparams;

	} else if ($cmdName =="weg" || $cmdName =="route") {
		// 1. Adressen dürfen fehlen
		if (sizeof($params) == 2) {
			$von = $params[0];
			$nach = $params[1];
			$params = array("", $von, "", $nach);
		}
	}

	// fill in empty args
	while (sizeof($params) < 6) {
		$params[sizeof($params)] = "";
	}
	return $params;
}

/////
// Execute request

$find = trim($_REQUEST["find"]);

$cmd = substr($find, 0, strpos($find, " "));
$cmd = strtolower($cmd);

if (strpos($find, " ") > 0) {
	$paramString = substr($find, strpos($find, " ") + 1);
}

$params = explode(",", $paramString);
$find = strtolower($find);

if (isset($cmd) && null != $cmds[$cmd]) {
	$cmds[$cmd]->execRequest(addDefaults($params, $cmd));
} elseif (null != $cmds[$find]) {
	$cmds[$find]->execRequest(addDefaults($params, $find));
} elseif (null != $links[$find]) {
	$links[$find]->execRequest(null);
} else {
	$cmds["google"]->execRequest($find);
}

$DEBUG = false;
if ($DEBUG) {
	print "find-string: $find<br/>";
	print "cmd:$cmd<br/>";
	print "param0:" . $params[0] . "<br/>";
	print "param1:" . $params[1] . "<br/>";
	print "param2:" . $params[2] . "<br/>";
}
?>
