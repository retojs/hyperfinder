# How To Host Hyperfinder

## FTP

host: login-1.hoststar.ch
user: hyperfinder.paradox.ch



---------

Hyperfinder Version 2.007

hyperfinder.js erstellen: 
	_develop/concat.xml als ant Build ausführen! (rechts-klick -> Run as Ant Build)
	

MINI-DOKU
=========

Das Herz von hyperfinder ist die JS-funktion gotoURL() in _gotoUrl.js. Sie leitet die Formulardaten der verschiedenen Such-Slots weiter an die entsprechenden Suchseiten.
Das Array urls[] enthält die URLs der Suchseiten assoziiert mit einem String, genannt "target".
In den URLs können die Strings <1> bis <6> vorkommen. Diese werden ersetzt mit den values der Eingabefelder mit id target_arg1 bis target_arg6.
Da je nach Suchfeld eines Slots die target URL variieren kann (z.B. bei den Diktionären), gibt es verschiedene Variablen, die das zuletzt-editierte Feld speichern.
