<?php

require_once "_util.php";

$feedback = $_REQUEST["feedback"];
$to = $_REQUEST["to"];
$absender = $_REQUEST["absender"];
$subject = $_REQUEST["subject"];
$message = $_REQUEST["message"];

if (!isset($message)) {
	$message  = "Hallo\n";
	$message .= "\n";
	$message .= "Schau dir mal diese Seite an: http://hyperfinder.ch\n";
	$message .= "\n";
	$message .= "Ist recht praktisch. Von hier hast du direkt Zugriff auf die wichtigsten Seiten, z.B. ";
	$message .= "Google, Leo, Wikipedia, den SBB Fahrplan, Adressverzeichnis, Telefonbuch, Routenplaner, Wetterprognosen,  Fernseh- und Kinoprogramm, Ricardo, Ebay, Amazon usw.\n";
	$message .= "Und ausserdem immer die aktuellsten News via RSS aus den verschiedensten Quellen. \n";
	$message .= "\n";
	$message .= "Als Sartseite bringt's hyperfinder am meisten, finde ich.\n";
	$message .= "Was denkst du?\n";
	$message .= "\n";
	$message .= "Gruss\n";
}
if (!isset($subject)) {
	$subject = "Meine neue Startseite...";
}

// handle email form
if (isset($feedback) && isset($to) && $to != "" && isset($absender) && $absender != "") {
	$from_header = "From: $absender";
	mail($to, $subject, $message, $from_header);
	$mailsent = true;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<?php printHTMLHeader(true) ?>
	<body>
		<form action="share.php" method="post">	
			<div align="center">
				<div id="mainpage">
					<?php printLogoHeader("share", null) ?>
					
					<div id="shareIntro">
						<?php if (!isset($mailsent)) { ?>
						<br/><strong>Wer Hyperfinder praktisch findet, sollte das nicht f&uuml;r sich behalten...</strong>
						<p>Ihre Freunde k&ouml;nnen Hyperfinder sicher genauso gut gebrauchen wie Sie. 
						Und ausserdem hilft jeder, der über Hyperfinder sucht, die Seite am Leben zu erhalten. Schliesslich m&uuml;ssen die Hosting-Geb&uuml;hren irgendwie bezahlt werden... und genau das k&ouml;nnen Sie tun. Mit Ihrer Maustaste.
						Denn zum Gl&uuml;ck sind Ihre Klicks Geld wert, da Google f&uuml;r jeden vermittelten Klick auf eine Google-Anzeige Provision zahlt.
						Wenn Sie also Hyperfinder weiterempfehlen und selber ab und zu auf eine Google-Anzeige klicken, bekommen Sie und Ihre Freunde am schnellsten, was sie suchen, und die Hosting-Geb&uuml;hren f&uuml;r hyperfinder.ch sind ganz nebenbei auch gedeckt.
						</p>
						<strong><a class="linkCol" style="text-decoration:underline" href="mailto:<?php print "?subject=" . rawurlencode($subject) . "&body=" . rawurlencode($message); ?>">das eigene Email-Programm verwenden</a></strong>
						<?php } ?>		
						<br/>
					</div>
					
					<table id="main_table" class="shareForm" border="0" cellspacing="0" cellpadding="4">

						<?php if (!isset($mailsent)) { ?>
						
						<tr>
							<td class="labels">Email schicken an: *</td>
							<td>
								<input type="hidden" name="feedback" value="set">
								<input type="text" name="to" value="<?php print $to ?>" style="width:500px">
								<?php 
									if (isset($feedback) && (!isset($to) || $to == "")) {
										print "<div class=\"error\">Hier m&uuml;ssen sie angeben, an wen das Email geschickt werden soll.</div>";
									} else {
										print "&nbsp;<br/>";
									}
								?> 
							</td>
						</tr>
						<tr>
							<td class="labels">Absender: *</td>
							<td>
								<input type="text" name="absender" value="<?php print $absender ?>" style="width:500px">
								<?php 
									if (isset($feedback) && (!isset($absender) || $absender == "")) {
										print "<div class=\"error\">Ohne g&uuml;ltige Emailadresse weiss ihr Freund vermutlich nicht, wer sie sind.</font>";
									} else {
										print "&nbsp;<br/>";
									}
								?> 
							</td>
						</tr>
						<tr>
							<td class="labels">Betreff:&nbsp;&nbsp;&nbsp;</td>
							<td>
								<input type="text" name="subject" style="width:500px" value="<?php print $subject; ?>">
							</td>
						</tr>
						<tr>
							<td class="labels">Ihre Einladung:&nbsp;&nbsp;&nbsp;</td>
							<td>
								<textarea name="message" rows="15" style="width:500px"><?php print htmlentities($message); ?></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" value="abschicken">	
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								* Emailadressen werden nicht an Dritte weitergegeben.
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<img src="leer.gif" height="5" alt="" >
							</td>
						</tr>
						
						<?php }	else if (isset($mailsent)) { ?>
					
						<tr>
							<td></td>
							<td>
								<br/>
								<div class="rubriken">Ihre Nachricht wurde verschickt. Vielen Dank!</div>
								<br/>								
								<a href="index.php">zur&uuml;ck zur Hauptseite</a>
								<br/>
								<br/>
							</td>
						</tr>
						
						<?php } ?>		
					
					</table>	
	  				<img src="img/leer.gif" height="10" width="2" />
	  			</div>
			</div>
		</form>
	</body>
</html>
