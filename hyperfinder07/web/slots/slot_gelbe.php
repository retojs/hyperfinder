<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.directories.ch/gelbeseiten"><?php echo $labels[$slot]; ?></a>
	</td>
	<td nowrap>
		Firma, Rubrik, Stichwort, Produkt:
		<br>
		<input type="text" id="gelbe_arg1" class="wideinput" onFocus="selectField('gelbe_arg1')" onKeyDown="onPressKey('gelbe')">
	</td>
	<td nowrap>
		Ort / PLZ:
		<br>
		<input type="text" id="gelbe_arg2" onFocus="selectField('gelbe_arg2')" onKeyDown="onPressKey('gelbe')">
	</td>
	<td nowrap class="linkCol">
		<a href="javascript:onPressKey('gelbe');gotoURL('gelbeExt');">Erweiterte Suche</a>	
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('gelbe');gotoURL()">
	</td>
</tr>