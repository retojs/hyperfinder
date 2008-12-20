<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.swisswebcams.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<a name="webcams"></a>
		<input type="text" name="sbgr" id="webcams_arg1" onFocus="selectField('webcams_arg1')" onKeyDown="onPressKey('webcams')">
		Ort
	</td>
	<td colspan="2" class="linkCol">
		<a href="javascript:linkTo('http://www.swisswebcams.ch/deutsch/kategorien.php', 'webcams')">Kategorie w&auml;hlen</a>
		|
		<a href="javascript:linkTo('http://www.swisswebcams.ch/deutsch/karte.php', 'webcams')">Webcam Karte</a></td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('webcams');gotoURL()">
	</td>
</tr>