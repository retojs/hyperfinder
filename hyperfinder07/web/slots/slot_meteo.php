<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.meteoschweiz.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		Lokalprognose:
		<br/>
		<input type="text" name="plz" id="meteo_arg1" onFocus="selectField('meteo_arg1')" onKeyDown="onPressKey('meteo');setLastField('meteo_plz')">
		PLZ / Ort
	</td>
	<td class="separator_left">
		Prognose von ...
		<br/>
		<select id="prognosen" onChange="onPressKey('meteo');setLastField('meteo_prognosen');gotoURL()">
			<option value="http://www.meteoschweiz.admin.ch/web/de/wetter.html">Meteo Schweiz</option>
			<option value="http://www.sf.tv/sfmeteo/">SF Meteo</option>
			<option value="http://www.nzz.ch/nachrichten/wetter/wetter_aktuell_1.118.html">NZZ</option>
			<option value="http://www.tagesanzeiger.ch/dyn2/wetter/prognose/index.html">Tagesanzeiger</option>
			<option value="http://www.blick.ch/wetter/schweiz">Blick</option>
		</select>
	</td>
	<td class="separator_left linkCol">
		<a href="javascript:linkTo('http://www.nzz.ch/nachrichten/wetter/radarbild_gross_1.133.html', 'meteo')" id="meteo_radar">Niederschlagsradar</a>	
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('meteo');gotoURL()">
	</td>
</tr>