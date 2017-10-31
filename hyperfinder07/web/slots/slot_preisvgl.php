<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<?php echo $labels[$slot]; ?>
	</td>
	<td>
		<input type="text" id="preisvgl_arg1" onFocus="selectField('preisvgl_arg1')" onKeyDown="onPressKey('preisvgl')">
		Produkt
	</td>
	<td colspan="2">
		<select id="preisvgl_site" class="wideinput" onChange="onPressKey('preisvgl');gotoURL()">
			<option value="2">toppreise.ch</option>
			<option value="3">preisvergleich.ch</option>
			<option value="1">preissuchmaschine.ch</option>
			<option value="4">guenstiger.ch</option>
			<option value="5">suche.ch/preisvergleich</option>
		</select>
		Plattform
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('preisvgl');gotoURL()">
	</td>
</tr>