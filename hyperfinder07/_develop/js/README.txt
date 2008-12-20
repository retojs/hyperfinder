Um den Javascript code übersichtlicher zu strukturieren, ist er aufgeteilt in verschiedene files, die per ant build.xml zusammen-"kompiliert" werden.

Versions-Management
-------------------

Um einerseits das cachen von javascript zu unterstützen und trotzdem änderungen sofort zur verfügung zu haben, 
gibt's bei jeder Javascript-Änderung eine neue Endung, welche die Version angibt.

Die Version im file gzip.php muss mit dieser aktuellen Version übereinstimmen!


USER DATA
=========

Um die Anzahl cookies klein zu halten, werden nur noch das Logo und eine userid als cookie gespeichert.
Anhand dieser userid werden dann die Daten via Ajax vom Server nachgeladen. 

(!) Damit dieser Mechanismus auf hoststar funktioniert, muss man der Datei _last_userid.txt im directory DO_NOT_DELETE Schreibrechte erteilen.
Diese Datei speichert die zuletzt erteilte user-ID und ermöglicht, dass jedem neuen user eine eigene ID zugeteilt wird.

(!) Wie der Name schon sagt sollte das Directory DO_NOT_DELETE nie gelöscht werden, weil damit alle Benutzerdaten gelöscht würden.


NEWS
====

## Initialzustand:

slots/slot_news.php plus news/news.php enthält das Grundgerüst der Seite mit einigen leeren DIVs, die per Ajax gefüllt werden. 

## Initialisierung: 

Die Sache ins Rollen bringt initPage(...) in _main.js.
Hier wird restoreNewsSettings() in news/_settings.js aufgerufen.
Hier wird zuerst der Bereich zum Auswählen der news vesteckt oder sichtbar gemacht, und anschliessend wird toggleNewsMode() aufgerufen.
Hier werden zunächst die in cookies gespeicherten selektionen bzw. keywords geladen.
Dann wird je nach news mode setCurrentKeyword() in settings.js oder setCurrentFeed() in feeds.js aufgerufen und die News geladen


Character encoding
------------------

Yes, we know it's a hassle.

Grundsätze: 

Vergiss es, die Sache lokal zu testen. Es muss nur auf hoststar funktionieren. Und dort ist alles ganz anders...

So fliessen die Daten:
	[FEED SOURCE SERVER] ==> [MY HOSTSTAR SERVER] -> XML Parser -> Output ==> [CLIENT BROWSER]

Letztendlich fliessen immer Bits und Bytes, die von sich aus nicht verändert werden. 
Denn wenn eine Datei mit der falschen codierung gelesen wird, werden die Bits zwar falsch interpretiert, aber nicht verändert.
Zeichen können aber explizit konvertiert werden.

Erfahrungs-werte:

1. die codierung von index.php muss iso-8859-1, sonst werden bei Suchanfragen die Umlaute falsch übermittelt.
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

2. Auf hoststar verhält sich alles anders als lokal und im Safari auf Mac wieder anders.
   Einfluss nehmen und rumschrauben kann man an diesen Stellen: 
   
   - parserRSS.php: 
     - parseRSS($url): 
        - $xml_parser = xml_parser_create("encoding"); ... dabei hat ein leerer String scheints eine spezielle Funktion
   		- xml_parser_set_option($xml_parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
   		- $fp = fopen($url, "rb") (binary) oder nur "r"...
     - characterData($parser, $data):
     	- $data = utf8_decode($data);
     	
   - _ajax_ticker_js_feeds.php:
     - header("Content-Type: text/html; charset=utf-8"); 
      	$title = htmlentities(noBr($title));
      	$summary = htmlentities(noBr($summary));

Tatsache ist: Für hoststar gibt es keine Lösung, die für alle Feeds funktioniert. 
Darum gibt es in der Klasse Newsfeed die Variable $utf8, die per default auf true gesetzt ist
und angibt, ob die Daten per utf8_decode() konvertiert werden sollen oder nicht. *

* Optimierung: Weil keine praktikable Lösung ist, für jeden einzelnen Feed die korrekte codierung herauszufinden,
Lesen wir die codierung selbständig aus dem XML-deklaration. Nur falls keine angegeben ist, wird das von hand spezifizierte flag verwendet.
Das von hand spezifizierte flag wird mittels Stichproben für alle Feeds einer Webseite geschätzt.


Ausserdem muss man bei Newsfeeds unterscheiden, ob der Inhalt Text oder ein Image-Tag ist (bei Comics).
Falls es ein image-Tag ist, darf der inhalt nicht codiert werden.


Sonderzeichen, die codiert sind (z.B. - als &#8211;), irritieren den XML Parser.
Noch ist nicht klar, wieso andere codierungen (b.B. ä als &#228;) den XML Parser nicht genauso irritieren...
Alle bekannten irritierenden Codierungen werden vor dem parsen darum entfernt bzw. ersetzt.

Manchmal liegt ein codierungsfehler auch beim Lieferanten eines feeds vor. Z.B. ist in "Karl&amp;#039;s Kühne Gassenschau" zuviel des Guten codiert...
Man könnte natürlich auch hier sagen: Der String &amp;# sollte generell übersetzt werden in ein &#