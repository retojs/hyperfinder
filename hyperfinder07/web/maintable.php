<?php require_once "_util.php"; ?>

<?php printLogoHeader("main") ?>

<table id="main_table" border="0" cellspacing="0" cellpadding="4">
		
	<?php printSlots($slots, $labels); ?>
	
	<tr><td>&nbsp;</td></tr>
	<tr class="info">
		<td class="info_left">
			<strong>Wie?</strong>
		</td>
		<td colspan="4" class="info_right">
			<div>
				Suchfeld ausw&auml;hlen, Suchbegriff eingeben und mit <strong> &nbsp;ENTER</strong> die Anfrage starten.
			</div>
			<div style="float:left">
				<input class="smallinput" type="checkbox" id="newwin" value="true" onClick="toggleNewWin()" checked>
			</div>
			<div style="float:left">
				Ergebnis in neuem Fenster anzeigen. (Dazu muss der Browser Popups f&uuml;r hyperfinder.ch zulassen.)
	  		</div>
	  	</td>
	</tr>
	<tr>
		<td colspan="5"><img src="img/leer.gif" height="1" alt="" ></td>
	</tr>
	<tr class="info">
		<td class="info_left">
			<strong>Wieso?</strong>
		</td>
		<td colspan="4" class="info_right">
			Weil's einfach schneller geht und wir es uns sparen können, jedesmal wenn wir im Internet etwas suchen wollen, einen Browser zu &ouml;ffnen, eine URL einzutippen und zu warten, bis wir endlich unsere Suchanfrage eingeben können. 
			<br>
			Tip: Wenn hyperfinder.ch als Startseite definiert ist, kann man ihn einfach per <span class="altkey">ALT-HOME</span> aufrufen.
		</td>
	</tr>
</table>
<table id="footer">
	<tr>
		<!-- online seit dem 27.1.2006 -->
		<td>&nbsp;</td>
		<td align="center"><input type="submit" style="width:0px;height:0px;"></td>
		<td align="right">&nbsp;<!-- <iframe src="counter.htm" name="counterframe" height="20" scrolling="no" frameborder="0"></iframe> --></td>
	</tr>
	<tr>
		<td colspan="3">
			   <a href="http://www.fraktale.ch/atsphp-5.2.1/"><img src="http://www.fraktale.ch/atsphp-5.2.1/button.php?u=hyperfinder" alt="Topliste Schweiz" border="0" /></a>
		</td>
	</tr>
</table>
