<?php

function editor_printHeader($newButton) {
	global $BASE_URL;
	?>
<tr>
	<th class="colFront">
	<?php if ($newButton) { ?> 
		<input type="button" value="Neu" onClick="document.location.href='<?php print $BASE_URL ?>newcmd=true'" />
	<?php } ?>
	</th>
	<th class="cmdTable">Kürzel</th>
	<th class="cmdTable">Suchbegriff(e)</th>
	<th class="cmdTable">Suchdienst, URL</th>
	<th class="cmdTable">Beispiel</th>
	<th class="rowInvisible"></th>
</tr>
	<?php
}

function editor_printCmdCols($cmd, $suchbegriffe, $suchdienst, $beispiel) {
	?>
	<td><?php print $cmd ?>&nbsp;</td>
	<td><?php print $suchbegriffe ?>&nbsp;</td>
	<td><?php print $suchdienst ?>&nbsp;</td>
	<td><?php print $beispiel ?>&nbsp;</td>
	<?php
}

/**
 * Rendert eine Zeile = ein benutzerdefiniertes Kommando
 * Letzter parameter $editOnClick darf keine Anführungszeichen (") enthalten!
 */
function editor_printRow($index, $cmdId, $cmd, $suchbegriffe, $suchdienst, $beispiel, $editOnClick) {
	?>
<tr>
	<td class="colFront"><input type="button" value="ändern" onClick="<?php print $editOnClick ?>" /></td>
	<?php editor_printCmdCols($cmd, $suchbegriffe, $suchdienst, $beispiel) ?>
	<td class="assignEmail_plain" style="width:20px"><input type="checkbox" name="myCmd_<?php print $index ?>" value="<?php print $cmdId ?>" /></td>
</tr>
	<?php
}

function editor_printRowSelected($cmd, $suchbegriffe, $suchdienst, $beispiel) {
	?>
<tr class=selectedCommands>
	<td class="colFront"></td>
	<?php editor_printCmdCols($cmd, $suchbegriffe, $suchdienst, $beispiel) ?>
	<td class="rowInvisible" style="width:20px"><input type="checkbox" style="visibility:hidden"></td>
</tr>
	<?php
}

function editor_printRowEmbedMe($index, $cmdId, $cmd, $suchbegriffe, $suchdienst, $beispiel, $code) {
	global $SERVER_ROOT;
	?>
<tr><td colspan="6" style="border:0px"></td></tr>
<tr>
	<td class="colFront"></td>
	<?php editor_printCmdCols($cmd, $suchbegriffe, $suchdienst, $beispiel) ?>
	<td class="rowInvisible"></td>
</tr>
<tr class="rowEdit_">
	<td class="colFront"><b>HTML-Code:</b></td>
	<td colspan="4" style="width:99%">
		<input type="text" style="width:98%"
			value="<a href='<?php print $SERVER_ROOT; ?>index.php?page=user&op=embedMe&id=<?php print $cmdId;?>&code=<?php print $code ?>' title='Hyperfinder Kommando &quot;<?php print $cmd;?>&quot; installieren'><img src='http://hyperfinder.ch/favicon.gif' border=0></a>" 
			onClick="this.select()"
		/>
	</td>
	<td class="rowInvisible" style="width:20px;background-color:#fff"></td>
</tr>
	<?php
}

function editor_printRowEdit($cmdid, $newcmd, $cmd, $url, $suchbegriffe, $suchdienst, $beispiel, $method, $params) {
	global $BASE_URL;

	$post = strtoupper($method) == "POST";
	$get = $post? false: true;
	$postDisabled = $post? "": "disabled";

	?>
<tr class="rowEdit">
	<td class="colFront">Kommando:</td>
	<td><input type="text" style="width: 97%" name="cmd" value="<?php print $cmd ?>" /></td>
	<td colspan="3">Die Angaben "<i>Suchbegriff(e)</i>", "<i>Suchdienst, URL</i>" und "<i>Beispiel</i>" sind optional. Sie dienen nur
	der Dokumentation ihres Kommandos. Die Felder sollten ausgefüllt werden, bevor Sie ein Kommando an Freunde weiterschicken.</td>
</tr>
<tr class="rowEdit">
	<td class="colFront">Dokumentation:</td>
	<td><input type="hidden" name="cmdid" value="<?php print $cmdid ?>" /><input type="hidden" name="newcmd"
		value="<?php print $newcmd ?>" /></td>
	<td><input type="text" style="width: 97%" name="suchbegriffe" value="<?php print $suchbegriffe ?>" /></td>
	<td><input type="text" style="width: 97%" name="suchdienst" value="<?php print $suchdienst ?>" /></td>
	<td><input type="text" style="width: 97%" name="beispiel" value="<?php print $beispiel ?>" /></td>
</tr>
<tr class="rowEdit">
	<td class="colFront">URL:</td>
	<td colspan="4"><input type="text" style="width: 99%" name="url" value="<?php print $url ?>" /></td>
</tr>
<tr class="rowEdit">
	<td class="colFront"></td>
	<td colspan="4">Kopieren Sie in dieses Feld die URL, die Sie mit diesem Kommando aufrufen wollen.</td>
</tr>
<tr class="rowEdit">
	<td class="colFront"></td>
	<td colspan="4">URL mit Variablen: Die Ausdrücke <i>&lt;1&gt;</i>, <i>&lt;2&gt;</i>, <i>&lt;3&gt;</i>, <i>&lt;4&gt;</i>, <i>&lt;5&gt;</i>
	und <i>&lt;6&gt;</i> in der URL werden bei einer Suchanfrage mit den Suchbegriffen ersetzt, die hinter dem Kommando-Kürzel stehen
	(mit Kommas getrennt).</td>
</tr>
<tr class="rowEdit">
	<td class="colFront"></td>
	<td colspan="4">Beispiel: Die URL "<i>http://map.search.ch/<b>&lt;2&gt;</b>/<b>&lt;1&gt;</b></i>" aufgerufen mit dem Kommando "<i>mapsearch
	<b>xyz</b>, <b>ZH</b></i>" ergibt: "<i>http://map.search.ch/<b>ZH</b>/<b>xyz</b></i>"</td>
</tr>
<tr class="rowEdit_">
	<td class="colFront">Method:</td>
	<td colspan="4"><input type="radio" name="method" value="GET" onClick="disable('params')"
	<?php print $get? "checked=checked": "" ?> /> GET &nbsp; <input type="radio" name="method" value="POST" onClick="enable('params')"
	<?php print $post? "checked=checked": "" ?> /> POST (Nur für erfahrene Benutzer. Speichern Sie in Hyperfinder Kommandos niemals
	Zugangsdaten (Login, Passwort)!</td>
</tr>
<tr class="rowEdit_">
	<td class="colFront">POST Parameter:</td>
	<td colspan="4"><input type="text" style="width: 97%" id="params" name="params" value="<?php print $params ?>" 
	<?php print $postDisabled; ?> /></td>
</tr>
<tr class="rowEdit_">
	<td class="colFront"></td>
	<td colspan="4">Schreibweise: <i>Parameter1=Wert1, Parameter2=Wert2, ...</i> (mit Kommas getrennt) <br />
	Die Werte <i>&lt;1&gt;</i>, ..., <i>&lt;6&gt;</i>, werden bei einer Suchanfrage mit den Suchbegriffen ersetzt, die hinter dem
	Kommando-Kürzel stehen (mit Kommas getrennt).</td>
</tr>
<tr class="rowEdit">
	<td class="colFront"><input type="button" value="Abbrechen" onClick="document.location.href='<?php print $BASE_URL ?>'" /></td>
	<td colspan="4"><input type="submit" name="save" value="Speichern" /> <input type="submit" name="delete" value="Löschen"
		id="deleteBtn" onclick="return confirm('Aktuellen Eintrag wirklich löschen');" /></td>
</tr>
<tr><td colspan="6" style="border:0px"></td></tr>
	<?php
}

?>
