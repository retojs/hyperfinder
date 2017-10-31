<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://map.search.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td nowrap>
		<a name="mapsearch"></a>
		<input name="addr" type="text" id="mapsearch_arg1" onFocus="selectField('mapsearch_arg1')" onKeyDown="onPressKey('mapsearch')">&nbsp;Adresse
		<br>
		<input name="plz_ort" type="text" id="mapsearch_arg2" onFocus="selectField('mapsearch_arg2')" onKeyDown="onPressKey('mapsearch')">
		PLZ / Ort
	</td>
	<td colspan="2">&nbsp;</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('mapsearch');gotoURL()">
	</td>
</tr>