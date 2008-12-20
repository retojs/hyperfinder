<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/ebay.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://ebay.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<input name="satitle" type="text" class="wideinput" id="ebay_arg1" onFocus="selectField('ebay_arg1')" onKeyDown="onPressKey('ebay')">
	</td>
	<td colspan="2">
		<select id="ebay_arg2" class="wideinput" onkeydown="onPressKey('ebay');submitForm(event)">
			<option value="">
				Alle Kategorien
			</option>
			<option value="353">
				Antiquitäten &amp; Kunst
			</option>
			<option value="10614">
				Audio &amp; Hi-Fi
			</option>
			<option value="9800">
				Auto &amp; Motorrad
			</option>
			<option value="12081">
				Baby
			</option>
			<option value="12155">
				Beauty &amp; Gesundheit
			</option>
			<option value="260">
				Briefmarken
			</option>
			<option value="267">
				Bücher
			</option>
			<option value="160">
				Computer
			</option>
			<option value="62682">
				Feinschmecker
			</option>
			<option value="11232">
				Filme &amp; DVDs
			</option>
			<option value="625">
				Foto &amp; Camcorder
			</option>
			<option value="14675">
				Handy &amp; Organizer
			</option>
			<option value="20710">
				Haushaltsgeräte
			</option>
			<option value="3187">
				Heimwerker &amp; Garten
			</option>
			<option value="11450">
				Kleidung &amp; Accessoires
			</option>
			<option value="22128">
				Modellbau
			</option>
			<option value="11700">
				Möbel &amp; Wohnen
			</option>
			<option value="11116">
				Münzen
			</option>
			<option value="11233">
				Musik
			</option>
			<option value="619">
				Musikinstrumente
			</option>
			<option value="14616">
				PC- &amp; Videospiele
			</option>
			<option value="11730">
				Reise
			</option>
			<option value="1">
				Sammeln &amp; Seltenes
			</option>
			<option value="220">
				Spielzeug
			</option>
			<option value="888">
				Sport
			</option>
			<option value="8529">
				Tickets
			</option>
			<option value="293">
				TV, Video &amp; Elektronik
			</option>
			<option value="281">
				Uhren &amp; Schmuck
			</option>
		</select>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('ebay');gotoURL()">
	</td>
</tr>