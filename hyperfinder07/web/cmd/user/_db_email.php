<?php
require_once("../_db.php");

function emailConfirmed($userid) {
	$result = execQuery("SELECT * FROM emailaddrs WHERE userid = '$userid' AND confirmcode='ok'");
	if (mysql_num_rows($result) > 0) {
		return mysql_result($result, 0, "emailaddr");
	} else {
		return false;
	}
}

function existsUserId($userid) {
	$result = execQuery("SELECT * FROM emailaddrs WHERE userid = '$userid'");
	return (mysql_num_rows($result) > 0);
}

/**
 * Assoziiert diese userid mit dieser Email-Adresse.
 * Es kann vorkommen, dass diese Operation mehrmals hintereinander ausgef�hrt wird
 * (z.B. wenn der user das Best�tigungs-Email versehentlich gel�scht oder vorher eine falsche Adresse eingegeben hat),
 * darum muss gepr�ft werden, ob bereits ein Eintrag in der DB vorhanden ist.
 * --> Jede userid kommt nur ein einziges mal for in der Tabelle emailaddrs (Schl�sselattribut).
 */
function saveAsEmail($userid, $email, $confirmcode) {
	if (!existsUserId($userid)) {
		$q = "INSERT INTO emailaddrs ";
		$q .= " SET userid = '$userid', emailaddr='$email', confirmcode='$confirmcode'";
	} else {
		$q = "UPDATE emailaddrs ";
		$q .= " SET userid = '$userid', emailaddr='$email', confirmcode='$confirmcode'";
		$q .= " WHERE userid = '$userid'";
	}
	execQuery($q);
}

function confirmEmail($userid, $code) {
	$result = execQuery("SELECT * FROM emailaddrs WHERE userid = '$userid'");
	if (mysql_num_rows($result) <= 0) {
		return "Fehler: userid '<i>$userid</i>' nicht vorhanden. Sorry, bitte versuchen Sei es noch einmal!";
	} else {
		$confirmcode = mysql_result($result, 0, "confirmcode");
		$emailaddr = mysql_result($result, 0, "emailaddr");
		if (trim($code) == trim($confirmcode)) {
			$result = execQuery("UPDATE emailaddrs SET confirmcode ='ok' WHERE userid = '$userid'");
			if (!$result){
				return "Fehler: Emailadresse konnte nicht best�tigt werden. Sorry, bitte versuchen Sei es noch einmal!";
			} else {
				return "Emailadresse erfolgreich best�tigt. <p>Ihre Kommandos sind nun der Email-Adresse <i>$emailaddr</i> zugeordnet.</p>";
			}
		} else if (trim($confirmcode) == "ok") {
			return "Die Emailadresse wurde bereits best�tigt. <br/>Ihre Kommandos sind nun der Email-Adresse <i>$emailaddr</i> zugeordnet.";
		} else {
			return "Fehler: Falscher Best�tigungscode. Benutzen Sie den Link im zuletzt gesendeten Email.";
		}
	}
}

?>