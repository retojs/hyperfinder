<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/google.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.google.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<input tabindex="<?php print $tabindex[$slot]; ?>" name="q" type="text" class="wideinput" id="google_arg1" onFocus="selectField('google_arg1')" onKeyDown="onPressKey('google')">
	</td>
	<td nowrap>
		<div id="google_select" style="margin-top:2px;margin-bottom:2px;width:150px">
			<select id="google_arg2" onkeydown="onPressKey('google');submitForm(event)" onChange="enableGoogleDECH()">
				<option value="custom" selected>
					Web
				</option>
				<option value="images">
					Bilder
				</option>
				<option value="maps">
					Maps
				</option>
				<option value="groups">
					Groups
				</option>
				<option value="searchDir">
					Verzeichnis
				</option>
				<option value="news">
					News
				</option>
			</select>
		</div>
	</td>
	<td nowrap>
		<input class="smallinput" type="checkbox" id="google_arg3" onKeyDown="onPressKey('google')" onClick="setGoogleDE()">
Seiten auf deutsch<br>
		<input class="smallinput" type="checkbox" id="google_arg4" onKeyDown="onPressKey('google')" onClick="setGoogleCH()">
Seiten aus der Schweiz </td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('google');gotoURL()">
	</td>
</tr>