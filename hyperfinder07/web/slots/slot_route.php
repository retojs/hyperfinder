<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen">
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://viamichelin.de"><?php echo $labels[$slot]; ?></a>
	</td>
	<td nowrap>
		<input name="strStartAddress" type="text" id="route_arg1" onFocus="selectField('route_arg1')" onKeyDown="onPressKey('route')">
		Start Adresse
		<br>
		<input name="strStartCity" type="text" id="route_arg2" onFocus="selectField('route_arg2')" onKeyDown="onPressKey('route')">
		Start Ort
		<br>
		<select id="route_arg5" onkeydown="onPressKey('route');submitForm(event)" >
			<option value="856">Andorra</option>
			<option value="311">Belgien</option>
			<option value="1025343">Bosnien-Herzegowina</option>
			<option value="1025340">Bulgarien</option>
			<option value="1473">Dänemark</option>
			<option value="240">Deutschland</option>
			<option value="1860861">Estland</option>
			<option value="EUR">Europa</option>
			<option value="1792">Finnland</option>
			<option value="1424">Frankreich</option>
			<option value="1945835">Griechenland</option>
			<option value="919">Irland</option>
			<option value="612">Italien</option>
			<option value="1145795">Kanada</option>
			<option value="1752">Kroatien</option>
			<option value="1851089">Lettland</option>
			<option value="108">Liechtenstein</option>
			<option value="1851066">Litauen</option>
			<option value="247">Luxemburg</option>
			<option value="1025334">Mazedonien</option>
			<option value="1025352">Moldau, Republik</option>
			<option value="852">Monaco</option>
			<option value="285">Niederlande</option>
			<option value="1574">Norwegen</option>
			<option value="106">Österreich</option>
			<option value="1743">Polen</option>
			<option value="669">Portugal</option>
			<option value="1025349">Rumänien</option>
			<option value="1851058">Russische Föderation</option>
			<option value="318">San Marino</option>
			<option value="1507">Schweden</option>
			<option value="185" selected>Schweiz</option>
			<option value="1025346">Serbien und Montenegro</option>
			<option value="1697">Slowakei</option>
			<option value="1746">Slowenien</option>
			<option value="844">Spanien</option>
			<option value="1694">Tschechische Republik</option>
			<option value="2059154">Türkei</option>
			<option value="1749">Ukraine</option>
			<option value="1741">Ungarn</option>
			<option value="2066810">Vatikanstaat</option>
			<option value="1145799">Vereinigte Staaten</option>
			<option value="1138">Vereinigtes Königreich</option>
			<option value="1794">Weißrußland</option>
		</select>
		Start Land
	</td>
	<td nowrap colspan="2">
		<input name="strDestAddress" type="text" id="route_arg3" onFocus="selectField('route_arg3')" onKeyDown="onPressKey('route')">
		Ziel Adresse
		<br>
		<input name="strDestCity" type="text" id="route_arg4" onFocus="selectField('route_arg4')" onKeyDown="onPressKey('route')">
		Ziel Ort
		<br>
		<select id="route_arg6" onkeydown="onPressKey('route');submitForm(event)" >
			<option value="856">Andorra</option>
			<option value="311">Belgien</option>
			<option value="1025343">Bosnien-Herzegowina</option>
			<option value="1025340">Bulgarien</option>
			<option value="1473">Dänemark</option>
			<option value="240">Deutschland</option>
			<option value="1860861">Estland</option>
			<option value="EUR">Europa</option>
			<option value="1792">Finnland</option>
			<option value="1424">Frankreich</option>
			<option value="1945835">Griechenland</option>
			<option value="919">Irland</option>
			<option value="612">Italien</option>
			<option value="1145795">Kanada</option>
			<option value="1752">Kroatien</option>
			<option value="1851089">Lettland</option>
			<option value="108">Liechtenstein</option>
			<option value="1851066">Litauen</option>
			<option value="247">Luxemburg</option>
			<option value="1025334">Mazedonien</option>
			<option value="1025352">Moldau, Republik</option>
			<option value="852">Monaco</option>
			<option value="285">Niederlande</option>
			<option value="1574">Norwegen</option>
			<option value="106">Österreich</option>
			<option value="1743">Polen</option>
			<option value="669">Portugal</option>
			<option value="1025349">Rumänien</option>
			<option value="1851058">Russische Föderation</option>
			<option value="318">San Marino</option>
			<option value="1507">Schweden</option>
			<option value="185" selected>Schweiz</option>
			<option value="1025346">Serbien und Montenegro</option>
			<option value="1697">Slowakei</option>
			<option value="1746">Slowenien</option>
			<option value="844">Spanien</option>
			<option value="1694">Tschechische Republik</option>
			<option value="2059154">Türkei</option>
			<option value="1749">Ukraine</option>
			<option value="1741">Ungarn</option>
			<option value="2066810">Vatikanstaat</option>
			<option value="1145799">Vereinigte Staaten</option>
			<option value="1138">Vereinigtes Königreich</option>
			<option value="1794">Weißrußland</option>
		</select>
		Ziel Land
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('route');gotoURL()">
	</td>
</tr>