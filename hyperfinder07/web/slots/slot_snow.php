<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://snow.search.ch/"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<a name="snow"></a>
		<input type="text" id="snow_arg1" onFocus="selectField('snow_arg1')" onKeyDown="onPressKey('snow');setLastField('snow_arg1')">
		PLZ / Ort
	</td>
	<td colspan="2">
		<!-- <select id="snow_arg2" class="wideinput" onkeydown="onPressKey('snow');setLastSnowField('snow_arg2');submitForm(event)">
			<option value="CH">Ganze Schweiz</option>
			<option value="top30">Top 30</option>
			<option value="reg7" >Berner Oberland</option>
			<option value="reg9" >Genferseegebiet</option>
			<option value="reg1" >Graub&uuml;nden</option>
			<option value="reg8" >NE / Jura / Berner Jura</option>
			<option value="reg2" >Ostschweiz / Liechtenstein</option>
			<option value="reg5" >Region Basel</option>
			<option value="reg13">Region Fribourg</option>
			<option value="reg3" >Region Z&uuml;rich</option>
			<option value="reg6" >Schweizer Mittelland</option>
			<option value="reg12">Tessin</option>
			<option value="reg11">Wallis</option>
			<option value="reg4" >Zentralschweiz</option>
		</select>
		 -->
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('snow');gotoURL()">
	</td>
</tr>