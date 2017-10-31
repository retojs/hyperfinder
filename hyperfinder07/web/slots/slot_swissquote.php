<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/swissquote.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.swissquote.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<input name="symbols" type="text" id="swissquote_arg1" onFocus="selectField('swissquote_arg1')" onKeyDown="onPressKey('swissquote')" value="SMI">
		Titel
	</td>
	<td colspan="2">&nbsp;</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('swissquote');gotoURL()">
	</td>
</tr>