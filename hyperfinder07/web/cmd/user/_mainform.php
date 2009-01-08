<?php include ("_global.php"); ?>

<?php editor_executeAction(); ?>
<?php email_executeAction($userid_); ?>
<?php embedMe_executeAction($userid_); ?>

<center><h2><?php print $headline ?></h2></center>

<?php editor_printSelectedCommands($commandSet) ?>

<? if ($feedback != null && sizeof(trim($feedback)) > 0) { ?>
	<center><div style="text-align: left;">
	<p><b><?php print $feedback; ?></b></p>
	</div></center>
<?php } ?>

<form action="<?php print $BASE_URL ?>" method="POST" id="commandTable">
	
	<?php editor_printCommandTable($userid_);?>

	<?php 
		$confirmedEmail = emailConfirmed($userid_);
		if (!$confirmedEmail) { 
	?>
	<br/>
	<div class="borderTop">
		<p><h3>Kommandos sichern</h3><b>Achtung: Diese Kommandos sind nicht (mehr) gesichert!</b></p>
		<p>Im Moment identifiziert sich Ihr Browser nur �ber ein Cookie (<a target="_blank" href="http://de.wikipedia.org/wiki/Cookie">?</a>). Es besteht die Gefahr, dass Sie oder jemand anders dieses
		Cookie l�scht und Ihre pers�nlichen Kommandos unwiederbringlich verloren sind.<br/>
		Ausserdem k�nnen Sie diese Kommandos nur mit diesem Browser und auf diesem PC verwenden.</p>
		<p>L�sung: Speichern Sie Ihre pers�nlichen Kommandos unter Ihrer Email-Adresse ab!</p>
		<div class="assignEmail">
			<b>Email-Adresse:</b>&nbsp;<input type="text" name="email_saveAs" style="width:300px"/>
			<input type="submit" value="Zuordnen" onclick="$('commandTable').action='<?php print $BASE_URL . "op=saveAs"; ?>';$('commandTable').submit()"/>
		</div>
		<br/>
		So funktioniert's:
		<ol>
			<li>Email-Adresse eingeben und "Zuordnen" klicken.</li>
			<li>Hyperfinder schickt ihnen dann ein Best�tigungs-Email.</li>
			<li>Klicken Sie den Best�tigungs-Link in diesem Email, um Ihre Kommandos dieser Email-Adresse zuzuordnen.</li>
		</ol>	
		<p>Auch danach identifziert sich Ihr Browser noch �ber ein Cookie bei Hyperfinder (um ihnen das Einloggen zu ersparen).
		Doch sollte dieses Cookie einmal gel�scht werden, sind Ihre Kommandos nicht verloren. Sie k�nnen sie �ber Ihre Email-Adresse einem neuen Cookie zuordnen. Genauso k�nnen Sie Ihre
		pers�nlichen Kommandos auch auf einem anderen Computer / Browser verwenden. F�r beides gehen Sie nochmal genau gleich vor.</p>
		<br/>
		<br/>
	</div>
	<?php } else { ?>
		<p>Das Cookie dieses Browsers und seine Kommandos sind gesichert unter der Email-Adresse: <i><?php print $confirmedEmail ?></i>.</p>
		<p class="assignEmail"><b>Email-Adresse �ndern:</b>&nbsp;<input type="text" name="email_saveAs" style="width:300px"/> 
		<input type="submit" value="Zuordnen" onclick="$('commandTable').action='<?php print $BASE_URL . "op=saveAs"; ?>';$('commandTable').submit()"/></p>
	<?php } ?>
			
	<?php
		$email_sendTo = $_REQUEST["email_sendTo"];
		$email_from = $_REQUEST["email_from"];
		$email_message = $_REQUEST["email_message"];
		if (!isset($email_from)) {
			$email_from = $confirmedEmail;
		}
		if (!isset($email_message)) {
			$email_message = "Hallo (Name), hier sind ein paar Hyperfinder-Kommandos. Um sie zu �bernehmen �ffnest du den untenstehenden Link in deinem Browser.";
		}
	?>
	<div class="borderTop">
		<h3>Kommandos verschicken</h3>
		<p>Sie k�nnen oben in der Liste Kommandos ausw�hlen und sie einem Freund schicken.</p>
		<div class="sendToEmail">
			<table>
				<tr>
					<td style="text-align:right; width:1%" nowrap><b>Email-Adresse Ihres Freundes:</b></td>
					<td><input type="text" name="email_sendTo" value="<?php print $email_sendTo; ?>" style="width:300px"/></td>
				</tr>
				<tr>
					<td style="text-align:right; width:1%" nowrap><b>Absender-Adresse:</b></td>
					<td><input type="text" value="<?php print $email_from; ?>" name="email_from" style="width:300px"/></td>
				</tr>
				<tr>
					<td style="text-align:right; vertical-align:top"><b>Text:</b></td>
					<td><textarea name="email_message" rows="3" cols="60"><?php print $email_message; ?></textarea>
						<input type="submit" value="Senden" onclick="$('commandTable').action='<?php print $BASE_URL . "op=sendTo"; ?>';$('commandTable').submit()"/>
					</td>
				</tr>
			</table>
		</div>
		<br/>
		<br/>
	</div>
	<div class="borderTop">
		<h3>Kommandos publizieren</h3>
		<p>Wenn Sie den untenstehenden HTML-Code zu einem Kommando in Ihre eigene Webseite integrieren, k�nnen die Besucher Ihrer Seite das Kommando per Mausklick importieren.
		So k�nnen Sie Besuchern, die Hyperfinder benutzen, vereinfachten Zugriff auf Ihre Webseite verschaffen.</p>
		<p>Sie k�nnen ihr Kommando auch demn�chst auf Hyperfinder ver�ffentlichen...</p>
		
		<?php editor_printEmbedMeCommands($userid_);?>

	</div>
	<br/>
	<br/>
	<br/>
</form>

<?php // <p><a href="../_setUserId.php">User Id setzen</a></p> ?>

