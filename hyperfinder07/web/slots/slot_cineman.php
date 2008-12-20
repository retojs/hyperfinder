<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/cine.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://cineman.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td nowrap>
		<a name="cineman"></a>
		<input type="text" id="cineman_arg1" onFocus="selectField('cineman_arg1')" onKeyDown="onPressKey('cineman');setLastField('cineman_arg1')">
		PLZ
	</td>
	<td nowrap colspan="2" class="separator_left">
		<input type="text" id="cineman_arg4" onFocus="selectField('cineman_arg4')" onKeyDown="onPressKey('cineman');setLastField('cineman_arg4')">
		Stichwort
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('cineman');gotoURL()">
	</td>
</tr>