<tr class="<?php print "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://exsila.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<a name="amazon"></a>
		<input type="text" class="wideinput" id="amazon_arg1" onFocus="selectField('amazon_arg1')" onKeyDown="onPressKey('amazon')">
	</td>
	<td colspan="2">
		
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('amazon');gotoURL()">
	</td>
</tr>