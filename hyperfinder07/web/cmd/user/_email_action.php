<?php
/**
 * Contains functions to execute email actions:
 *
 *   op = saveAs:
 * 				Die dem Cookie zugeordneten Kommandos einer Email-Adresse zuordnen.
 *
 *   op = confirm:
 * 				Email-Adresse bestätigen
 *
 *   op = sendTo:
 * 				Selektierte Kommandos kopieren (mit temporärer userid='share_xxx') und einem Freund eine Installier-Einladung schicken.
 *
 *   op = accept:
 * 				Installier-Einladung annehmen.
 *
 */

function email_executeAction($userid) {
	global $userid_, $headline, $feedback, $commandSet;

	if ($_GET["op"] == "saveAs") {
		$email = $_REQUEST["email_saveAs"];

		$headline = "Kommandos einer Email Adresse zuordnen (Schritt 2/3)";
		$feedback = email_saveAs($userid, $email);

	} elseif ($_GET["op"] == "confirm") {
		$request_userid = $_GET["userid"];
		$code = $_REQUEST["code"];

		$headline = "Kommandos einer Email Adresse zuordnen (Schritt 3/3)";
		$feedback = confirmEmail($request_userid, $code);

	} elseif ($_GET["op"] == "sendTo") {
		$email_sendTo = $_REQUEST["email_sendTo"];
		$email_from = $_REQUEST["email_from"];

		$headline = "Kommandos verschicken";
		$feedback = email_sendTo($email_sendTo, $email_from);

	} elseif ($_GET["op"] == "accept") {
		$request_userid = $_GET["userid"];
		$cookie_userid = $userid_;
		$code = $_REQUEST["code"];

		$headline = "Kommandos installieren";
		$feedback = "Sorry, Kommandos installieren fehlgeschlagen.";

		$commandSet = getCommandSet2(getAcceptCommandSet($request_userid));
		$affected = acceptCommands($cookie_userid, $request_userid);
		if ($affected > 0) {
			$feedback = (($affected == 1)? "1 Kommando" : "$affected Kommandos") . " erfolgreich installiert.";
		}
	}
}

function email_saveAs($userid, $email) {
	global $SERVER_ROOT, $BASE_URL;

	$emailOk = (strpos($email, "@") > 0) && (strpos($email, "@") < strpos($email, ".", strpos($email, "@")));

	if ($emailOk) {
		$confirmcode = createCode(24);
		saveAsEmail($userid, $email, $confirmcode);

		$from_header = "From: $email";
		$subject = "Hyperfinder Kommandos dieser Email Adresse zuordnen";
		$message = "Klicken Sie diesen Link, um ihre Email-Adresse zu bestätigen: \n\n";
		$message .= $SERVER_ROOT . $BASE_URL . "op=confirm&userid=" . $userid . "&code=" . $confirmcode;

		// print "message " . $message;
		
		mail($email, $subject, $message, $from_header);

		return "Es wurde ein Email an die Adresse <i>$email</i> geschickt.</p><p>Bitte klicken Sie zur Bestätigung den Link in diesem Email.";
	} else {
		return "Die Email-Adresse <i>$email</i> ist ungültig. Es wurde kein Email verschickt.";
	}
}

function email_sendTo($email_sendTo, $email_from) {
	global $SERVER_ROOT, $BASE_URL;
	global $commandSet;

	$email_sendToOk = (strpos($email_sendTo, "@") > 0) && (strpos($email_sendTo, "@") < strpos($email_sendTo, ".", strpos($email_sendTo, "@")));
	$email_fromOk = (strpos($email_from, "@") > 0) && (strpos($email_from, "@") < strpos($email_from, ".", strpos($email_from, "@")));

	if ($email_sendToOk && $email_fromOk) {

		$commandSet = getCommandSet();
		$anyCommands = trim($commandSet) != "";

		if ($anyCommands) {

			$nextUserId = getNextId();
			$affected = shareCommands($commandSet, $nextUserId);

			$from_header = "From: ".$email_from;
			$subject = "Hyperfinder Kommandos installieren";
			$message = $_REQUEST["email_message"] . "\n\n";
			if (strpos($message, "(Name)") > 0) {
				// replace <Name> with the first part of the Email address
				$destName = substr($email_sendTo, 0, strpos($email_sendTo, "@"));
				if (strpos($destName, ".") > 0) {
					$destName_ = explode(".", $destName);
					$destName = "";
					$separator = "";
					foreach ($destName_ as $namePart) {
						$destName .= $separator . strtoupper(substr($namePart, 0, 1)) . substr($namePart, 1);
						$separator = " ";
					}
				} else {
					$destName = strtoupper(substr($destName, 0, 1)) . substr($destName, 1);
				}
				$message = str_replace("(Name)", $destName, $message);
			}
			$message .= $SERVER_ROOT . $BASE_URL . "op=accept&userid=" . $nextUserId;
			
			mail($email_sendTo, $subject, $message, $from_header);
		}
	}

	if (!$email_sendToOk) {
		return "Die Email-Adresse <i>$email_sendTo</i> Ihres Freundes kann nicht stimmen. Es wurde kein Email verschickt.";
	} elseif (!$email_fromOk) {
		return "Die Absender-Adresse <i>$email_from</i> ist ungültig. Es wurde kein Email verschickt.";
	} elseif ($anyCommands) {
		return "Ein Email wurde geschickt an <i>$email_sendTo</i>.</p><p>Ihr Freund muss nun den Link in diesem Email öffnen, um die Kommandos in seinen Browser zu installieren.";
	} else  {
		return "<font color=red>Keine Kommandos ausgewählt. Es wurde kein Email verschickt.</font>";
	}
}

function getCommandSet() {
	$nofCmds = $_REQUEST["nofCmds"];
	$commandSet = "";
	$separator = "";
	for ($i = 0; $i < $nofCmds; $i++) {
		if (isset($_REQUEST["myCmd_" . $i])) {
			$commandSet .= $separator . $_REQUEST["myCmd_" . $i];
			$separator = ",";
		}
	}
	return $commandSet;
}

function getCommandSet2($result) {
	$commandSet = "";
	$separator = "";
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
		$commandSet .= $separator . mysql_result($result, $i, "id");
		$separator = ",";
	}
	return $commandSet;
}
?>

