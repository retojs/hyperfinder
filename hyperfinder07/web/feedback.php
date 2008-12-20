<?php

require_once "_util.php";

$feedback = $_REQUEST["feedback"];
$to = $_REQUEST["to"];
$absender = $_REQUEST["absender"];
$message = $_REQUEST["message"];

// handle feedback form: send mail even without $absender
if (isset($feedback)) {
	$to = "info@hyperfinder.ch";
	$from_header = "From: $absender";
	$subject = "Feedback von hyperfinder";
	mail($to, $subject, $message, $from_header);
  
	if (isset($absender) && $absender != "") {
		$mailsent = true;
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<?php printHTMLHeader(true) ?>
	<body>
		<form action="feedback.php" method="post">
			<div align="center">
				<div id="mainpage">
					<?php printLogoHeader("feedback", null) ?>
					
					<div id="shareIntro">
						<?php if (!isset($mailsent)) { ?>
						<br/><strong>Sagen Sie mir die Meinung!</strong>
						<p>Man kann nicht an alles denken, darum bin ich immer interessiert in Ihren Ideen f&uuml;r Hyperfinder.
						<br/>Jeder PC ist anders bez&uuml;glich Betriebssystem, Browser, Bildschirmaufl&ouml;sung etc., darum bin ich dankbar, wenn Sie mir melden, falls bei Ihnen irgendetwas nicht richtig funktioniert. 
						</p>
						<?php } ?>		
						<br/>
					</div>
						
					<table id="main_table" class="shareForm" border="0" cellspacing="0" cellpadding="4">
					
						<?php if (!isset($mailsent)) { ?>
					
						<tr>
							<td class="labels">Ihre Emailadresse: *</td>
							<td>
								<input type="hidden" name="feedback" value="set">
								<input type="text" name="absender" style="width:500px">
								<?php 
									if (isset($feedback) && (!isset($absender) || $absender == "")) {
										print "<div class=\"error\">Ohne g&uuml;ltige Emailadresse kann ich Ihnen nicht antworten.</div>";
									} else {
										print "&nbsp;<br/>";
									}
								?> 
							</td>
						</tr>
						<tr>
							<td class="labels">Ihre Mitteilung / Frage / Anregung:</td>
							<td>
								<textarea name="message" rows="20" style="width:500px"><?php print $message; ?></textarea>
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
						
						<?php }	?>
							
					</table>	
	  				<img src="img/leer.gif" height="10" width="2" />
	  			</div>
			</div>
		</form>
	</body>
</html>
