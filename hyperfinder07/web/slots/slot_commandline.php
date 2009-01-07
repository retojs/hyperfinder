<tr class="<?php echo "css_" . $slotkey; ?>" id="commandline_slot">
	<td class="bigLabel linkCol2" title="http://cmd.hyperfinder.ch"> 
		<img src="img/favicons/_leer.gif" />&nbsp;
		<a href="http://cmd.hyperfinder.ch"><?php echo $labels[$slot]; ?></a>
	</td>
	<td colspan="3">
		<input tabindex="0" name="find" type="text" class="wideerinput" id="commandline_arg1" onFocus="selectField('commandline_arg1')" onKeyDown="onPressKey('commandline')"/>
		<span class="linkCol"><a href="javascript:toggleHelpCmdLine()">So funktioniert's</a></span>
		<script type="text/javascript">focusField('commandline_arg1');</script>
	</td>
	<td align="right" valign="top">
		<input type="button" class="gobutton" value="<?php print $TXT["FIND"] ?>" onClick="onPressKey('commandline');gotoURL()">
	</td>
</tr>
<tr>
	<td colspan="5">
		<div id="commandline_help" style="display:none">
<br/>
<p>
<h4>Ein Wort ist die einfachste Art etwas zu sagen...</h4>
Darum kann man mit Hyperfinder nun auch per <i>Suchkommando</i> suchen.
<br/>
Dank dieser Suchkommandos ist es nicht mehr n�tig, Suchanfragen in verschiedene Textfelder einzutippen. Es reicht eine einzige <i>Kommandozeile</i> f�r alle Suchdienste.
</p><p>
<h4>Beispiele f�r Suchkommandos</h4>
<ul>
<li>
<input type="text" value="fr haus" /> �bersetzt das Wort "Haus" auf Franz�sisch.
</li><li>
<input type="text" value="en house" /> �bersetzt das Wort "house" von Englisch nach Deutsch.
</li><li>
<input type="text" value="sbb bern, z�rich" /> Sucht &Ouml;V-Verbindungen von Bern nach Z�rich HB (ab jetzt).
</li><li>
<input type="text" value="sbb bern, zh, di, 1830" /> Sucht &Ouml;V-Verbindungen von Bern nach Z�rich HB am kommenden Dienstag um 18:30 
</li><li>
<input type="text" value="tv8" /> Zeigt an, was heute Abend um 8 Uhr Abends im Fernsehen l�uft.
</li><li>
<input type="text" value="irgendwas" /> Sucht via Google nach dem Stichwort "irgendwas"
</li>
</ul>
usw. Eine Liste aller K�rzel befindet sich hier: <a target="_blank" href="http://cmd.hyperfinder.ch/?page=help">Hilfe zur Hyperfinder Kommandozeile</a>
</p><p>
<h4>Das Suchkommando zu einem Suchdienst anzeigen</h4>
Um das K�rzel eines Suchdienstes kennen zu lernen, dr�cken Sie auf das gr�ne Quadrat am linken Rand davor:
<div style="text-align:center; padding:12px">
<img class="favicon" src="img/favicons/_cmd.gif"/>
oder
<img class="favicon" onclick="commandHelp('google')" src="img/favicons/google.gif"/>
<img class="favicon" onclick="commandHelp('wiki')" src="img/favicons/wiki.gif"/>
<img class="favicon" onclick="commandHelp('sbb')" src="img/favicons/sbb.gif"/>
<img class="favicon" onclick="commandHelp('ytube')" src="img/favicons/ytube.gif"/>
<img class="favicon" onclick="commandHelp('imdb')" src="img/favicons/imdb.gif"/>
<img class="favicon" onclick="commandHelp('ricardo')" src="img/favicons/ricardo.gif"/>
<img class="favicon" onclick="commandHelp('ebay')" src="img/favicons/ebay.gif"/>
<img class="favicon" onclick="commandHelp('amazon')" src="img/favicons/amazon.gif"/>
<img class="favicon" onclick="commandHelp('swissquote')" src="img/favicons/swissquote.gif"/>
</div>
Das Suchdienst-K�rzel (oder ev. mehrere Varianten, durch "/" getrennt) werden dann in der Kommandozeile angezeigt. 
<br/>
Die n�tigen Suchbegriffe sind jeweils in Klammern angegeben.
</p><p>
<h4>Suchkommandos lernen</h4>
Eine detailierte Anleitung mit einer Liste aller K�rzel finden Sie hier: <a target="_blank" href="http://cmd.hyperfinder.ch/?page=help">Hilfe zur Hyperfinder Kommandozeile</a>
</p><p>
Um die Vorteile der Kommandozeile wirklich nutzen zu k�nnen, kommt man nicht darum herum, ein paar K�rzel auswendig wissen. 
<br/>
Die Vorteile dabei liegen jedoch auf der Hand: Kein Scrollen, kein Klicken. Nur einfach ein paar Tasten dr�cken.
</p>

<h4>Hyperfinder Kommandozeile verwenden</h4>
<p>Wem Hyperfinder schon immer irgendwie zu un�bersichtlich war, der kann nun zur schlichten Kommandozeilen-Version</a> wechseln:
<div style="text-align:center; padding:12px"><b><a target="_blank" href="http://cmd.hyperfinder.ch">cmd.hyperfinder.ch</a></b></div>
Damit reduziert sich auch die Ladezeit von Hyperfinder.</p>
<p>Eine Hyperfinder Kommandozeile, die f�r PDAs und Handys optimiert ist, befindet sich unter der Adresse: 
<div style="text-align:center; padding:12px"><b><a target="_blank" href="http://pda.hyperfinder.ch">pda.hyperfinder.ch</a></b></div>
</p><p>
Wer Firefox benutzt, kann die Hyperfinder Kommandozeile ausserdem zur Liste der Search-Plugin oben rechts hinzuf�gen. 
</p><p>
<h4>Eigene Suchkommandos definieren</h4>
Sie k�nnen Hyperfinder individuell erweitern: <a target="_blank" href="http://cmd.hyperfinder.ch/?page=user">Meine Kommandos</a>
</p><p>
Ihre pers�nlichen Kommandos k�nnen sie an Freunde weiterschicken oder auf der eigenen Webseite publizieren.  
</p><p>
<b>Achtung!</b>:Vergessen Sie nicht, ihre Kommandos unter ihrer Email-Adresse zu speichern. Andernfalls gehen sie verloren, sobald ihr Browser-Cookie irgendwann gel�scht werden sollte.
Das speichern Ihrer Daten unter Ihrer Email-Adresse bietet eine sichere und trotzdem unkomplizierte Variante, sich eindeutig als Sie selber auszuweisen (es ist dadurch nicht jedesmal ein Login n�tig).  
</p>
<center><span class="linkCol"><a href="javascript:toggleHelpCmdLine();window.scroll(0,0);">schliessen</a></span></center>
		</div>
	</td>
</tr>