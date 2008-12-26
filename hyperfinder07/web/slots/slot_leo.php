<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol" title="Kommando anzeigen"> 
		<img class="favicon" src="img/favicons/_cmd.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<?php echo $labels[$slot]; ?>
	</td>
	<td>	
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td>
					<a href="http://dict.leo.org"><img src="img/en.gif" border="0" title="Deutsch - Englisch"></a> 
					<input tabindex="<?php print $tabindex[$slot."0"]; ?>" name="leo_search" type="text" id="leo_arg1" style="width:200" onFocus="selectField('leo_arg1')" onKeyDown="onPressKey('leo');setLastField('leo_en')">
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" NAME="opt" VALUE="d31111111">
					<input TYPE="hidden" NAME="suchen" VALUE="Übersetzen">
					<a href="http://dict.leo.org/esde"><img src="img/es.gif" border="0" title="Deutsch - Spanisch"></a>   
					<input tabindex="<?php print $tabindex[$slot."1"]; ?>" name="search" type="text" id="leo_arg3" style="width:200" onFocus="selectField('leo_arg3')" onKeyDown="onPressKey('leo');setLastField('leo_es')" >
				</td>
			</tr>
		</table>
	</td>
	<td colspan="2">
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td nowrap>
					<a href="http://dict.leo.org/frde"><img src="img/fr.gif" border="0" title="Deutsch - Französisch"></a> 
					<input tabindex="<?php print $tabindex[$slot."2"]; ?>" name="leo_search" type="text" id="leo_arg2" style="width:200" onFocus="selectField('leo_arg2')" onKeyDown="onPressKey('leo');setLastField('leo_fr')">
				</td>
			</tr>
			<tr>
				<td nowrap>
					<a href="http://dict.leo.org/itde"><img src="img/it.gif" border="0" title="Deutsch - Italienisch"></a> 
					<input tabindex="<?php print $tabindex[$slot."3"]; ?>" name="noname" type="text" id="leo_arg4" style="width:200" onFocus="selectField('leo_arg4')" onKeyDown="onPressKey('leo');setLastField('leo_it')"> 
				</td>
			</tr>
		</table>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('leo');gotoURL()">
	</td>
</tr>