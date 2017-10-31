<tr class="<?php echo "css_" . $slotkey; ?>">
	<td colspan="5">
		<span class="bigLabel linkCol">
			<a name="newsNPodcasts"></a>
			<img src="img/favicons/_leer.gif" />&nbsp;
			<?php echo $labels[$slot]; ?>
			&nbsp;
			<span id="currfeedlabel"></span>
		</span>
		&nbsp;&nbsp;
		<span class="linkCol">
			<a href="javascript:toggleNewsSelect()">ausw&auml;hlen</a>
			|
			<a href="javascript:disableNews()">abschalten</a>
			|
			<a href="javascript:toggleHelp()">Wie funktioniert's?</a>
		</span>
	</td>
</tr>

<tr class="<?php echo "css_" . $slotkey; ?>">
	<td colspan="5">
		<?php include("news/news.php"); ?>
	</td>
</tr>
