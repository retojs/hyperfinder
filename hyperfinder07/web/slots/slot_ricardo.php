<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/ricardo.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://affiliate.ricardo.ch/app/auc_aff/interface/?c=2&c_p=2&affid=10729&campid=19445"><?php echo $labels[$slot]; ?></a>
		<input type="hidden" name="OrderBy" value="CloseTime">
		<input type="hidden" name="SortOrder" value="1">
		<input type="hidden" name="do_search" value="1">
		<input type="hidden" name="mode" value="fast">
	</td>
	<td>
		<input name="include" type="text" class="wideinput" id="ricardo_arg1" onFocus="selectField('ricardo_arg1')" onKeyDown="onPressKey('ricardo')">
	</td>
	<td colspan="2">
		<div id="ricardo_select" style="margin-top:2px;margin-bottom:2px;width:220px">
			<select name="Catg" class="wideinput" id="ricardo_arg2" onkeydown="onPressKey('ricardo');submitForm(event)">
				<option value="1" selected>Alle Kategorien</option>
				<option value="38399">Antiquitäten & Kunst</option>
				<option value="38488">Audio & HiFi</option>
				<option value="38567">Auto & Motorrad</option>
				<option value="38766">Briefmarken</option>
				<option value="38889">Bücher & Comics</option>
				<option value="39037">Büro & Papeterie</option>
				<option value="39091">Computer & Netzwerk</option>
				<option value="39349">Filme & DVD</option>
				<option value="39460">Foto & Optik</option>
				<option value="39563">Games & Software</option>
				<option value="39735">Grosshandel & Gewerbe</option>
				<option value="39825">Handwerk & Garten</option>
				<option value="39940">Handy, Festnetz, Funk</option>
				<option value="40295">Haushalt & Wohnen</option>
				<option value="40520">Kind & Baby</option>
				<option value="40748">Kleidung & Accessoires</option>
				<option value="41057">Kosmetik & Pflege</option>
				<option value="41126">Modellbau & Hobby</option>
				<option value="41260">Münzen</option>
				<option value="41306">Musik</option>
				<option value="41432">Musikinstrumente</option>
				<option value="41518">Sammeln & Seltenes</option>
				<option value="41733">Spielzeug & Basteln</option>
				<option value="41875">Sport & Reisen</option>
				<option value="42099">Tickets & Gutscheine</option>
				<option value="42135">Tierwelt</option>
				<option value="42196">TV, Video & Elektronik</option>
				<option value="42272">Uhren & Schmuck</option>
				<option value="42454">Wein & Genuss</option>
			</select>
		</div>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('ricardo');gotoURL()">
	</td>
</tr>