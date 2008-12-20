<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/wiki.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://wikipedia.org"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<input tabindex="<?php print $tabindex[$slot]; ?>" name="wiki_search" type="text" class="wideinput" id="wiki_arg1" onFocus="selectField('wiki_arg1')" onKeyDown="onPressKey('wiki')">
	</td>
	<td colspan="2"></td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('wiki');gotoURL()">
	</td>
</tr>