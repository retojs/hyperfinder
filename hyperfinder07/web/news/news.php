<style type="text/css">
.google {background-color:#fff}
.google td {background-color:#fff;font-family:arial,sans-serif;font-size:16px}
.google a:link,.w,a.w:link,.w a:link{color:#00c}
.google a:visited,.fl:visited{color:#551a8b}
.google a:active,.fl:active{color:#f00}
.google div.n {margin-top: 1ex}
.google a b {font-size:16px}
.google nobr b {font-size:12px}
.p a:link,.p a:active,.p a:visited,.p{color:#008000}
</style>

<div style="display:none" id="help">
  <div class="intro dottedSeparator">
	<strong>So funktioniert's:</strong><br><br>
	Viele News-Webseiten bieten ihre aktuellsten Schlagzeilen inklusive Links zu den entsprechenden Artikeln als <a target="_blank" href="http://de.wikipedia.org/wiki/Really_Simple_Syndication">RSS Newsfeed</a> an.
	<br/>
	Handelt es sich nicht um geschriebene Artikel, sondern um Audio-Dateien, so nennt man den Newsfeed auch "<a target="_blank" href="http://de.wikipedia.org/wiki/Podcast">Podcast</a>". 
	<br/>
	<br/>
	Hyperfinder.ch kann einen Newsfeed ihrer Wahl anzeigen, oder Sie können das Internet nach News zu einem Thema per Stichwort absuchen. (News auswählen: <i>nach Stichwort</i>)
	<br/>
	<br/>
	Um eine Schlagzeile längere Zeit zu betrachten, führen Sie den Mauszeiger &uuml;ber den Bereich mit den Schlagzeilen. 
 	<div align="right" class="linkCol" style="padding-bottom:5px"><a href="javascript:toggleHelp()">schliessen</a></div>
  </div>
</div>

<div class="selectFeed" id="selectfeed" style="display:none">
	<div class="dottedSeparator">
		<strong>News ausw&auml;hlen:</strong>
		
		&nbsp;&nbsp;
		<input type="radio" class="newssearchmode" name="newssearchmode" id="newssearchmodebyTopic" onclick="toggleNewsMode()" value="byTopic">
		<a class="newssearchmode" href="javascript:toggleNewsMode('byTopic')"><nobr>nach Rubrik</nobr></a>
		&nbsp;&nbsp;
		<input type="radio" class="newssearchmode" name="newssearchmode" id="newssearchmodebyUrl" onclick="toggleNewsMode()" value="byUrl">
		<a class="newssearchmode" href="javascript:toggleNewsMode('byUrl')"><nobr>nach Webseite</nobr></a>
		&nbsp;&nbsp;
		<input type="radio" class="newssearchmode" name="newssearchmode" id="newssearchmodebyKeyword" onclick="toggleNewsMode()" value="byKeyword">
		<a class="newssearchmode" href="javascript:toggleNewsMode('byKeyword')"><nobr>nach Stichwort</nobr></a>
		&nbsp;&nbsp;
		<input type="radio" class="newssearchmode" name="newssearchmode" id="newssearchmodepodcasts" onclick="toggleNewsMode()" value="podcasts">
		<a class="newssearchmode" href="javascript:toggleNewsMode('podcasts')"><nobr>Podcasts</nobr></a>
		&nbsp;&nbsp;
		<input type="radio" class="newssearchmode" name="newssearchmode" id="newssearchmodeswissnews" onclick="toggleNewsMode()" value="swissnews" checked>
		<a class="newssearchmode" href="javascript:toggleNewsMode('swissnews')"><nobr>Schweizer Zeitungen</nobr></a>
		
		<div style="float:left; width:200px">&nbsp;</div>
		<div style="padding-top:4px">
			<div id="newsByTopic" style="display:none">
				<table cellpadding="3" cellspacing="0">
					<tr>
						<td>Thema:</td>
						<td id="select_byTopic_parent"></td>
					</tr>
					<tr>
						<td>Newsfeed:</td>
						<td id="feed_byTopic_parent"></td>
					</tr>
				</table>
			</div>
			<div id="newsByUrl" style="display:none">
				<table cellpadding="3" cellspacing="0">
					<tr>
						<td>Webseite:</td>
						<td id="select_byUrl_parent"></td>
					</tr>
					<tr>
						<td>Newsfeed:</td>
						<td id="feed_byUrl_parent"></td>
					</tr>
				</table>
			</div>
			<div id="newsByKeyword" style="display:none">
				Stichwort: &nbsp;
				<input type="text" name="newsKeyword" id="newsKeyword" value="<?php print htmlentities($stichwort) ?>" onFocus="selectField('newsKeyword')" onKeyDown="loadNewsOnEnter(event)">
				<input type="button" value="News anzeigen" onClick="loadNews()"/>
			</div>
			<div id="podcasts" style="display:none">
				<table cellpadding="3" cellspacing="0">
					<tr style="display:none">
						<td>Source (hide):</td>
						<td id="select_podcasts_parent"></td>
					</tr>
					<tr>
						<td>Podcast:</td>
						<td id="feed_podcasts_parent"></td>
					</tr>
				</table>
			</div>
			<div id="swissnews" style="display:none">
				<table cellpadding="3" cellspacing="0">
					<tr>
						<td>Zeitung:</td>
						<td id="select_swissnews_parent"></td>
					</tr>
					<tr>
						<td>Newsfeed:</td>
						<td id="feed_swissnews_parent"></td>
					</tr>
				</table>
			</div>
		</div>

		<div align="right" class="linkCol" style="padding-bottom:5px"><a href="javascript:toggleNewsSelect()">schliessen</a></div>
		
	</div>
</div>

<div class="<?php echo "css_" . $slotkey; ?>" id="newsDisplay" align="center"></div>

<div id="shareNewsForm" style="display:none">
	<table class="newsTable <?php echo "css_" . $slotkey; ?>">
		<tr>
			<td></td>
			<td colspan="3">
				<strong>Artikel per Email verschicken:</strong>
				&nbsp;&nbsp;
				<strong><a class="linkCol" id="openMailToolLink">das eigene Email-Programm verwenden</a></strong>
			</td>
		</tr>
		<tr>
			<td class="formLbl">Link:</td>
			<td colspan="3"><input type="text" id="shareNewsLink" class="formField" readonly /></td>
		</tr>
		<tr>
			<td class="formLbl">An:</td>
			<td><input type="text" id="shareNewsTo" class="formField" /></td>
			<td class="formLbl">Von:</td>
			<td><input type="text" id="shareNewsFrom" class="formField" /></td>
		</tr>
		<tr>
			<td class="formLbl">Nachricht:</td>
			<td colspan="3"><textarea id="shareNewsMsg" class="formField"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="3">
				<input type="button" value="Email abschicken" onclick="shareNews()">
				<input type="button" value="abbrechen" onclick="toggleShareNewsForm()">
			</td>
		</tr>
	</table>
</div>

	