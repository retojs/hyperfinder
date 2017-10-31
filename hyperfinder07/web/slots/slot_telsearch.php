<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://tel.search.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td nowrap>
		<input name="name" type="text" id="telsearch_arg1" onFocus="selectField('telsearch_arg1')" onKeyDown="onPressKey('telsearch')">
		Name
		<br>
		<input name="ort" type="text" id="telsearch_arg2" onFocus="selectField('telsearch_arg2')" onKeyDown="onPressKey('telsearch')">
		Nummer
		<br>
		<input name="misc" type="text" id="telsearch_arg3" onFocus="selectField('telsearch_arg3')" onKeyDown="onPressKey('telsearch')">
		Beruf
	</td>
	<td colspan="2">
		<input name="strasse" type="text" id="telsearch_arg4" onFocus="selectField('telsearch_arg4')" onKeyDown="onPressKey('telsearch')">
		Adresse
		<br>
		<input name="ort" type="text" id="telsearch_arg5" onFocus="selectField('telsearch_arg5')" onKeyDown="onPressKey('telsearch')">
		Ort
		<br>
		<select name="kanton" id="telsearch_arg6" onkeydown="onPressKey('telsearch');submitForm(event)">
			<option value="" selected>
				Alle
			</option>
			<option value="AG">
				AG
			</option>
			<option value="AI">
				AI
			</option>
			<option value="AR">
				AR
			</option>
			<option value="BE">
				BE
			</option>
			<option value="BL">
				BL
			</option>
			<option value="BS">
				BS
			</option>
			<option value="FR">
				FR
			</option>
			<option value="GE">
				GE
			</option>
			<option value="GL">
				GL
			</option>
			<option value="GR">
				GR
			</option>
			<option value="JU">
				JU
			</option>
			<option value="LU">
				LU
			</option>
			<option value="NE">
				NE
			</option>
			<option value="NW">
				NW
			</option>
			<option value="OW">
				OW
			</option>
			<option value="SG">
				SG
			</option>
			<option value="SH">
				SH
			</option>
			<option value="SO">
				SO
			</option>
			<option value="SZ">
				SZ
			</option>
			<option value="TG">
				TG
			</option>
			<option value="TI">
				TI
			</option>
			<option value="UR">
				UR
			</option>
			<option value="VD">
				VD
			</option>
			<option value="VS">
				VS
			</option>
			<option value="ZG">
				ZG
			</option>
			<option value="ZH">
				ZH
			</option>
		</select>
		Kanton
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('telsearch');gotoURL()">
	</td>
</tr>