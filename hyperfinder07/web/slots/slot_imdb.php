<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/imdb.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://imdb.com"><?php echo $labels[$slot]; ?></a>
	</td>
	<td colspan="3">
	<input name="for" type="text" id="imdb_arg1" onFocus="selectField('imdb_arg1')" onKeyDown="onPressKey('imdb')">
		Film, Schauspieler, Regisseur usw.
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('imdb');gotoURL()">
	</td>
</tr>