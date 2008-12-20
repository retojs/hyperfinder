<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<input type="hidden" name="queryPageDisplayed" value="yes">
		<input type="hidden" name="REQ0HafasSkipLongChanges" value="0">
		<input type="hidden" name="REQ0JourneyStops1.0A" value="1">
		<input type="hidden" name="REQ0JourneyStopsS0A" value="7">
		<input type="hidden" name="REQ0JourneyStopsZ0A" value="7">
		<input type="hidden" name="REQ0JourneyStopsS0ID">
		<input type="hidden" name="REQ0JourneyStopsZ0ID">
		<input type="hidden" name="REQ0HafasMaxChangeTime" value="120">
		<input type="hidden" name="Z" value="">
		<input type="hidden" name="S" value="">
		<input type="hidden" name="REQ0JourneyStops1.0G">
		<input type="hidden" name="wDayExt0" value="Mo|Di|Mi|Do|Fr|Sa|So">
		<input type="hidden" name="REQ0HafasSearchForw" id="hidden_sbb5">
		<input type="hidden" name="start" value="&#187; Verbindung suchen">
		<img class="favicon" src="img/favicons/sbb.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://sbb.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<input tabindex="<?php print $tabindex[$slot."0"]; ?>" name="REQ0JourneyStopsS0G" type="text" id="sbb_arg1" onFocus="selectField('sbb_arg1')" onKeyDown="onPressKey('sbb')">
		von
		<br/>
		<input tabindex="<?php print $tabindex[$slot."1"]; ?>" name="REQ0JourneyStopsZ0G" type="text" id="sbb_arg2" onFocus="selectField('sbb_arg2')" onKeyDown="onPressKey('sbb')">
		nach
	</td>
	<td colspan="2">
		<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td nowrap>
					<input tabindex="<?php print $tabindex[$slot."2"]; ?>" name="REQ0JourneyDate" type="text" id="sbb_arg3" onFocus="selectField('sbb_arg3')" onKeyDown="onPressKey('sbb')">&nbsp;am
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;<input class="smallinput" type="radio" name="sbb_anab" checked onKeyDown="onPressKey('sbb')">
					Abfahrt
				</td>
			</tr>
			<tr>
				<td nowrap>
					<input tabindex="<?php print $tabindex[$slot."3"]; ?>" name="REQ0JourneyTime" type="text" id="sbb_arg4" onFocus="selectField('sbb_arg4')" onKeyDown="onPressKey('sbb')">&nbsp;um
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;<input class="smallinput" type="radio" name="sbb_anab" id="sbb_an" onKeyDown="onPressKey('sbb')">
					Ankunft
				</td>
			</tr>
		</table>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('sbb');gotoURL()">
	</td>
</tr>