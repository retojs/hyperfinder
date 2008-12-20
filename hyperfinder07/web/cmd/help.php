<center><div id="content" style="text-align:left"><br/>
<center><a href="index.php">Hilfe schliessen</a><h2>Hilfe zur Hyperfinder Kommandozeile</h2></center>

<h3>1. Such-Kommandos und ihre Bestandteile</h3>
Suchanfragen werden als Worte (Kommandos) formuliert. Jedes Kommando besteht 
<ol>
<li>aus dem <i><b>K�rzel</b> f�r den Suchdienst</i> </li>
<li>aus den <i>mit Kommas getrennten <b>Suchbegriffen</b></i>, die dem Suchdienst �bergeben werden sollen</li>
</ol>
<p><center><input type="text" value="Such-K�rzel  Suchbegriff 1 , Suchbegriff 2 , ..." class="help_bsp" /></center></p><br/>

<h3>2. Beispiele f�r Such-Kommandos</h3>
<p>Das Such-K�rzel f�r das Deutsch-Englisch W�rterbuch lautet <strong>en</strong>. 
<br/>Das Kommando, um das Wort "Haus" nachzuschlagen, lautet also zum Beispiel:</p>
<p><center><input type="text" value="en haus" class="help_bsp" /></center></p>
<p>Das K�rzel f�r den SBB Fahrplan (auch ein Fahrplan f�r Tram und Bus) lautet <strong>sbb</strong>. 
<br/>Das Kommando, um �V-Verbindungen von Bern nach Z�rich Hardbr�cke nachzuschlagen, lautet also zum Beispiel:</p>
<p><center><input type="text" value="sbb bern, z�rich hardbr�cke" class="help_bsp" /></center></p>
<p>F�r eine Verbindung von Bern nach Z�rich HB am n�chsten Mittwoch um 12:30 schreiben Sie:</p>
<p><center><input type="text" value="sbb bern, zh, mi, 1230" class="help_bsp" /></center></p>
<br/>
<p>Google ist der Standard Suchdienst. Alle Eingaben, die nicht mit einem Such-K�rzel beginnen, werden an Google weitergeleitet. 
<br/>Falls Sie in Google nach einem Begriff suchen m�chten, der gleichzeitig ein K�rzel ist, stellen sie einfach das K�rzel <strong>google</strong> oder <strong>find</strong> vor den Suchbegriff. 
<br/>
Beispiel: Die Eingabe "SBB Billetpreise" w�rde zum SBB Fahrplan verweisen, da "sbb" ein Such-K�rzel ist. 
Um mit Google nach dem Stichwort "SBB Billetpreise" zu suchen, schreiben Sie:</p>
<p><center><input type="text" value="google SBB Billetpreise" class="help_bsp" /></center></p>
<p>Die Kommandos <strong>bild</strong> und <strong>maps</strong> f�hren zu zwei spezielle Suchdienste von Google. 
<br/>Um z.B. alle Angebote zum Stichwort "Velo" in der Region Davos auf einer Landkarte anzuzeigen, schreiben Sie:</p>
<p><center><input type="text" value="maps velo davos" class="help_bsp" /></center></p>
<p>Um z.B. Bilder von den Malediven anzuzeigen, schreiben Sie:</p>
<p><center><input type="text" value="bild malediven" class="help_bsp" /></center></p>

<h3>3. Liste aller Such-Kommandos</h3>

<table>
	<tr><td colspan="4" class="rubrik">BASIC:</td></tr>
	<tr>
		<th>K�rzel</th>
		<th>Suchbegriff(e)</th>
		<th>Suchdienst, URL</th>
		<th>Beispiel</th>
	</tr>
	<tr>
		<td>(leer) / google / find(e) / ?</td>
		<td>Stichwort</td>
		<td>Google (www.google.ch)</td>
		<td>find Rezept Zimtsterne</td>
	</tr>
	<tr>
		<td>bild</td>
		<td>Stichwort</td>
		<td>Google Bilder (www.google.ch)</td>
		<td>bild Miss Schweiz</td>
	</tr>
	<tr>
		<td>maps</td>
		<td>Stichwort</td>
		<td>Google Maps (maps.google.ch)</td>
		<td>maps Hotel Berlin</td>
	</tr>
	<tr>
		<td>en / leo</td>
		<td>Stichwort</td>
		<td>Englisch Dix (dict.leo.org)</td>
		<td>en liability</td>
	</tr>
	<tr>
		<td>fr</td>
		<td>Stichwort</td>
		<td>Franz�sisch Dix (dict.leo.org)</td>
		<td>fr appareil photo num�rique</td>
	</tr>
	<tr>
		<td>es</td>
		<td>Stichwort</td>
		<td>Spanisch Dix (dict.leo.org)</td>
		<td>es hasta la vista</td>
	</tr>
	<tr>
		<td>it</td>
		<td>Stichwort</td>
		<td>Italienisch Dix (www.ponsline.de)</td>
		<td>it ristretto</td>
	</tr>
	<tr>
		<td>wiki / wikipedia</td>
		<td>Stichwort</td>
		<td>Wikipedia (de.wikipedia.org)</td>
		<td>wiki Swasiland</td>
	</tr>
	<tr><td colspan="4" class="rubrik">NAVIGATION:</td></tr>
	<tr>
		<th>K�rzel</th>
		<th>Suchbegriff(e)</th>
		<th>Suchdienst, URL</th>
		<th>Beispiel</th>
	</tr>
	<tr>
		<td>sbb / zug</td>
		<td>Von, Nach (, Datum) (, Zeit (ab))</td>
		<td>Fahrplan (www.sbb.ch)</td>
		<td>sbb zh, lenzerheide, sa, 800 ab</td>
	</tr>
	<tr>
		<td>bus / tram / �v</td>
		<td>Von, Nach (, Datum) (, Zeit (ab))</td>
		<td>Tram & Bus Fahrplan (www.sbb.ch)</td>
		<td>�v basel sbb, basel st jakob, 2000</td>
	</tr>
	<tr>
		<td>route / weg</td>
		<td>Von Adresse, Von Ort, Nach Adresse, Nach Ort</td>
		<td>Routenplaner (www.viamichelin.de)</td>
		<td>weg Herbstweg 123, Schwamendingen, , Lenzerheide</td>
	</tr>
	<tr>
		<td>wo / ort / karte / plan</td>
		<td>Adresse, Ort</td>
		<td>Atlas, Landkarte (map.search.ch)</td>
		<td>wo zielweg, frauenfeld</td>
	</tr>
	<tr>
		<td>tel</td>
		<td>Was/Wer, Wo</td>
		<td>Telefonbuch (tel.search.ch)</td>
		<td>tel calmy rey</td>
	</tr>
	<tr><td colspan="4" class="rubrik">WETTER:</td></tr>
	<tr>
		<th>K�rzel</th>
		<th>Suchbegriff(e)</th>
		<th>Suchdienst, URL</th>
		<th>Beispiel</th>
	</tr>
	<tr>
		<td>meteo / wetter</td>
		<td>PLZ, Ort</td>
		<td>Lokale Wetterprognose (www.meteoschweiz.ch)</td>
		<td>wetter 8000</td>
	</tr>
	<tr>
		<td>cam / webcam</td>
		<td>PLZ, Ort</td>
		<td>Webcam vor Ort (www.meteoschweiz.ch)</td>
		<td>cam flims</td>
	</tr>
	<tr>
		<td>snow / schnee</td>
		<td>PLZ, Ort</td>
		<td>Lokaler Schneebericht (snow.search.ch)</td>
		<td>snow arosa</td>
	</tr>
	<tr>
		<td>radar / regen</td>
		<td>-</td>
		<td>Niederschlagsradar (www.meteoschweiz.ch)</td>
		<td>radar</td>
	</tr>
	<tr><td colspan="4" class="rubrik">UNTERHALTUNG:</td></tr>
	<tr>
		<th>K�rzel</th>
		<th>Suchbegriff(e)</th>
		<th>Suchdienst, URL</th>
		<th>Beispiel</th>
	</tr>
	<tr>
		<td>tv</td>
		<td>Stichwort</td>
		<td>Fernsehprogramm (www.teleboy.ch)</td>
		<td>tv prison break</td>
	</tr>
	<tr>
		<td>tvjetzt / tvj / tvnow</td>
		<td>-</td>
		<td>Fernsehprogramm, was l�uft jetzt?</td>
		<td>tvjetzt</td>
	</tr>
	<tr>
		<td>tv8 / tv20 / tv2015</td>
		<td>-</td>
		<td>Fernsehprogramm, was l�uft heute um 20:15?</td>
		<td>tv8</td>
	</tr>
	<tr>
		<td>tv9 / tv21 / tv2115</td>
		<td>-</td>
		<td>Fernsehprogramm, was l�uft heute um 21:15?</td>
		<td>tv21</td>
	</tr>
	<tr>
		<td>tv10 / tv22 / tv2215</td>
		<td>-</td>
		<td>Fernsehprogramm, was l�uft heute um 22:15?</td>
		<td>tv2215</td>
	</tr>
	<tr>
		<td>tv11 / tv23 / tv2315</td>
		<td>-</td>
		<td>Fernsehprogramm, was l�uft heute um 23:15?</td>
		<td>tv23:15</td>
	</tr>
	<tr>
		<td>sf</td>
		<td>-</td>
		<td>SF Videos</td>
		<td>www.sf.tv</td>
	</tr>
	<tr>
		<td>kino</td>
		<td>Stichwort</td>
		<td>Kinoprogramm nach Stichwort (www.cineman.ch)</td>
		<td>kino sandra bullock</td>
	</tr>
	<tr>
		<td>kinoin, kinowo</td>
		<td>PLZ, Ort</td>
		<td>Kinoprogramm nach PLZ, Ort (www.cineman.ch)</td>
		<td>kinoin Winterthur</td>
	</tr>
	<tr>
		<td>film / filme / trailer / trailiers</td>
		<td>-</td>
		<td>Kino Trailers</td>
		<td>www.apple.com/trailers</td>
	</tr>
	<tr>
		<td>yt / ytube / youtube</td>
		<td>Stichwort</td>
		<td>YouTube (www.youtube.com)</td>
		<td>ytube amy winehouse</td>
	</tr>
	<tr>
		<td>yt[mr/mv/tr/md][t/w/m]</td>
		<td>
			<ul>
				<li>mr: Most Recent</li>
				<li>mv: Most Viewed</li>
				<li>tr: Top Rated</li>
				<li>md: Most Discussed</li>
			</ul>
			<ul>
				<li>t: Today</li>
				<li>w: This Week</li>
				<li>m: This month</li>
			</ul>
		</td>
		<td>YouTube charts (www.youtube.com)</td>
		<td>
			<ul>
				<li>ytmr (most recent)</li>
				<li>ytmv (most viewed all time)</li>
				<li>yttr (top rated all time)</li>
				<li>ytmd (most discussed all time)</li>
				<li>ytmvt (most viewed today)</li>
				<li>yttrw (top rated this week)</li>
				<li>ytmdm (most discussed this month)</li>
			</ul>
		</td>
	</tr>
	<tr>
		<td>imdb</td>
		<td>Stichwort (Film, Schauspieler, Regisseur, etc.</td>
		<td>Internet Movie Database (www.imdb.com)</td>
		<td>imdb bree van de kamp</td>
	</tr>
	<tr><td colspan="4" class="rubrik">HANDEL:</td></tr>
	<tr>
		<th>K�rzel</th>
		<th>Suchbegriff(e)</th>
		<th>Suchdienst, URL</th>
		<th>Beispiel</th>
	</tr>
	<tr>
		<td>ricardo / ric</td>
		<td>Stichwort</td>
		<td>Ricardo Online Auktionen (www.ricardo.ch)</td>
		<td>ric ipod</td>
	</tr>
	<tr>
		<td>ebay</td>
		<td>Stichwort</td>
		<td>Ebay Online Auktionen (www.ebay.ch)</td>
		<td>ebay tastatur</td>
	</tr>
	<tr>
		<td>amazon / buch / dvd / cd</td>
		<td>Stichwort</td>
		<td>Amazon (www.amazon.ch)</td>
		<td>cd james blunt</td>
	</tr>
	<tr>
		<td>b�rse</td>
		<td>Titel</td>
		<td>B�rsenkurse (www.swissquote.ch)</td>
		<td>b�rse smi</td>
	</tr>
	<tr>
		<td>wechselkurs / kurs / geld</td>
		<td>Betrag, von, nach</td>
		<td>W�hrungskurse (www.oanda.com)</td>
		<td>kurs 100, USD, CHF</td>
	</tr>
	<tr>
		<td>vergleich / vgl</td>
		<td>Stichwort</td>
		<td>Preisvergleich (www.preisvergleich.ch)</td>
		<td>vgl ipod</td>
	</tr>
	<tr>
		<td>gelbe</td>
		<td>Stichwort / Ort</td>
		<td>Gelbe Seiten (www.directories.ch)</td>
		<td>gelbe velo, z�rich</td>
	</tr>
</table>

<p>Bei Anfragen mit mehreren Suchbegriffen k�nnen einige Suchbegriffe auch weggelassen werden.</p>

<h3>Wann braucht es Kommas und wann nicht?</h3>
<p>Es gilt die Faustregel: Kommas trennen die verschiedenen Textfelder der alten Hyperfinder-Suchformulare. Was bisher ins selbe Textfeld geschrieben wurde, bleibt unver�ndert ohne Kommas. 
</p>
<br/>

<center><p><a href="index.php">Hilfe schliessen</a></p></center>

</div></center>