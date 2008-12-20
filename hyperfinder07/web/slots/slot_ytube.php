<tr class="<?php echo "css_" . $slotkey; ?>">
	<td class="bigLabel linkCol"> 
		<img class="favicon" src="img/favicons/ytube.gif" onclick="commandHelp('<?php print $slot; ?>')" />&nbsp;
		<a href="http://www.youtube.com"><?php echo $labels[$slot]; ?></a>
	</td>
	<td>
		<input type="text" id="ytube_arg1" onFocus="selectField('ytube_arg1')" onKeyDown="onPressKey('ytube')">
		Stichwort
	</td>
	<td nowrap class="separator_left">
		Suchfilter <select style="visibility:hidden; width:10px;"> </select>
		<br/>
		<select name="id" id="ytube_arg2" onChange="setLastField('ytube_cat')" onKeyDown="onPressKey('ytube');gotoURL()">
			<option value="mr">Most Recent</option>
			<option value="mp">Most Viewed</option>
			<option value="tr">Top Rated</option>
			<option value="md">Most Discussed</option>
			<option value="mf">Top Favorites</option>
			<option value="mrd">Most Linked</option>
			<option value="rf">Recently Featured</option>
			<option value="ms">Most Responded</option>
		</select>
	</td>
	<td>
		<select name="id" id="ytube_arg4" onChange="setLastField('ytube_cat')" onKeyDown="onPressKey('ytube');gotoURL()">
			<option value="0">All</option>
			<option value="2">Autos &amp; Vehicles</option>
			<option value="23">Comedy</option>
			<option value="24">Entertainment</option>
			<option value="1">Film &amp; Animation</option>
			<option value="20">Gadgets &amp; Games</option>
			<option value="26">Howto &amp; DIY</option>
			<option value="10">Music</option>
			<option value="25">News &amp; Politics</option>
			<option value="22">selected People &amp; Blogs</option>
			<option value="15">Pets &amp; Animals</option>
			<option value="17">Sports</option>
			<option value="19">Travel &amp; Places</option>
		</select>
		<br/>
		<select name="id" id="ytube_arg3" onChange="setLastField('ytube_cat')" onKeyDown="onPressKey('ytube');gotoURL()">
			<option value="t">Today</option>
			<option value="w">This Week</option>
			<option value="m">This Month</option>
			<option value="a">All Time</option>
		</select>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('ytube');gotoURL()">
	</td>
</tr>