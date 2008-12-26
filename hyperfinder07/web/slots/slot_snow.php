<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://snow.search.ch/"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<a name="snow"></a>
		<input type="text" name="rn" id="snow_arg1" onFocus="selectField('snow_arg1')" onKeyDown="onPressKey('snow');setLastField('snow_arg1')">
		PLZ / Ort
	</td>
	<td colspan="2">
		<select name="rr" id="snow_arg2" class="wideinput" onkeydown="onPressKey('snow');setLastSnowField('snow_arg2');submitForm(event)">
			<option value="0">Alle Regionen</option>
			<option value="1" >Graub&uuml;nden</option>
			<option value="2" >Ostschweiz / Liechtenstein</option>
			<option value="3" >Region Z&uuml;rich</option>
			<option value="4" >Zentralschweiz</option>
			<option value="5" >Region Basel</option>
			<option value="6" >Schweizer Mittelland</option>
			<option value="7" >Berner Oberland</option>
			<option value="8" >Freiburg / Neuenburg / Jura / Berner Jura</option>
			<option value="9" >Genferseegebiet</option>
			<option value="11" >Wallis</option>
			<option value="12" >Tessin</option>
		</select>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('snow');gotoURL()">
	</td>
</tr>