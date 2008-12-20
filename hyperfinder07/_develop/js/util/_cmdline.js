
var cmdhelp = new Array();
cmdhelp["amazon"] = "amazon / buch / dvd / cd (Suchbegriff)";
cmdhelp["cineman"] = "kinoin / kinowo (Ort/PLZ) // kino (Stichwort)";
cmdhelp["ebay"] = "ebay (Stichwort)";
cmdhelp["fx"] = "wechselkurs / kurs / geld (Betrag), (Währung), (Zielwährung)";
cmdhelp["gelbe"] = "gelbe (Stichwort)";
cmdhelp["google"] = "(Stichwort) // google / find(e) / ? // bild // maps (Stichwort)";
cmdhelp["imdb"] = "imdb (Stichwort)";
cmdhelp["leo"] = "leo / en / fr / es / it (Wort)";
cmdhelp["mapsearch"] = "wo / ort / plan / karte (Strasse), (Ort)";
cmdhelp["meteo"] = "meteo / wetter (Ort / PLZ) // radar";
cmdhelp["preisvgl"] = "vergleich / vgl (Stichwort)";
cmdhelp["ricardo"] = "ric / ricardo (Stichwort)";
cmdhelp["route"] = "route / weg (von Adresse), (von Ort), (nach Adresse), (nach Ort)";
cmdhelp["sbb"] = "sbb / öv (von), (nach) (, Datum) (, Zeit (ab))";
cmdhelp["snow"] = "snow / schnee (Ort / PLZ)";
cmdhelp["swissquote"] = "börse (Titel)";
cmdhelp["telsearch"] = "tel (Was / Wer), (Wo)";
cmdhelp["tv"] = "tv / tvjetzt / tv8 / tv9 / ...";
cmdhelp["webcams"] = "cam / webcam (Ort / PLZ)";
cmdhelp["wiki"] = "wiki / wikipedia (Stichwort)";
cmdhelp["ytube"] = "yt[mr/mv/tr/md][t/w/m]";

var id_cmdLine = "commandline_arg1";

var id_helpCmdLine = "commandline_help";
var helpCmdLine = false;

function toggleHelpCmdLine() {
	helpCmdLine = !helpCmdLine;
	hideShowIf(id_helpCmdLine, helpCmdLine);
}

function selectCmdLine() {
	$(id_cmdLine).select(0, $(id_cmdLine).value.length);
}