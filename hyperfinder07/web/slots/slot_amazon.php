<tr class="<?php print "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/amazon.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://amazon.de"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<a name="amazon"></a>
		<input name="field-keywords" type="text" class="wideinput" id="amazon_arg1" onFocus="selectField('amazon_arg1')" onKeyDown="onPressKey('amazon')">
	</td>
	<td colspan="2">
		<select name="url" class="wideinput" id="amazon_arg2" onkeydown="onPressKey('amazon');submitForm(event)">
			<option value="index=blended" selected>
				Alle Produkte
			</option>
			<option value="index=books-de">
				B&uuml;cher
			</option>
			<option value="index=books-de-intl-us">
				Englische B&uuml;cher
			</option>
			<option value="index=magazines-de">
				Zeitschriften
			</option>
			<option value="index=pop-music-de">
				Pop Musik
			</option>
			<option value="index=classical-de">
				Klassik
			</option>
			<option value="index=dvd-de">
				DVD
			</option>
			<option value="index=dvd-de&amp;field-is-rentable=1&amp;field-dvd-region=2">
				Ausleih-DVDs
			</option>
			<option value="index=vhs-de">
				Video VHS
			</option>
			<option value="index=ce-de-all">
				Elektronik &amp; Foto
			</option>
			<option value="index=pc-de">
				Computer &amp; Zubeh&ouml;r
			</option>
			<option value="index=photo-de">
				Kamera &amp; Foto
			</option>
			<option value="index=kitchen-de-all">
				Haus &amp; Garten
			</option>
			<option value="index=kitchen-de">
				K&uuml;che &amp; Haushalt
			</option>
			<option value="index=tools-de">
				Heimwerken
			</option>
			<option value="index=garden-de">
				Garten &amp; Freizeit
			</option>
			<option value="index=hpc-de">
				K&ouml;rperpflege &amp; Bad
			</option>
			<option value="index=software-de">
				Software
			</option>
			<option value="index=video-games-de">
				PC- &amp; Videospiele
			</option>
			<option value="index=toys-de">
				Spielwaren
			</option>
		</select>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('amazon');gotoURL()">
	</td>
</tr>