<?php

/**
 * Enth�lt die URLS aller Suchdienste, sortiert nach Kommando-K�rzeln
 * Um URLS speziell f�r PDAs zu definieren, einfach die Entsprechende Zeile nach _urls_pda.php kopiern und anpassen.
 */

$cmds = array ();
$links = array ();

/////
// BASIC

//$goorl = "http://www.google.ch/custom";
//$goorl .= "?hl=de";
//$goorl .= "&ie=ISO-8859-1";
//$goorl .= "&oe=ISO-8859-1";
//$goorl .= "&client=pub-3941083662020418";
//$goorl .= "&cof=FORID%3A1%3BGL%3A1%3BBGC%3AFFFFFF%3BT%3A%23000000%3BLC%3A%230000cc%3BVLC%3A%23660099%3BALC%3A%230000cc%3BGALT%3A%23009900%3BGFNT%3A%239999cc%3BGIMP%3A%239999cc%3BDIV%3A%230000cc%3BLBGC%3AFFFFFF%3BAH%3Acenter%3B";
//$goorl .= "&q=<1>";
//$goorl .= "&btnG=Suche";
//$goorl .= "&meta=on";
$goorl = "http://www.google.ch/#sclient=psy&hl=de&site=&source=hp&q=<1>&rlz=1R2GGLL_de&pbx=1&oq=<1>&aq=f&aqi=g5&aql=&gs_sm=e&gs_upl=1672l1922l0l2062l4l3l0l0l0l0l234l391l0.1.1l2l0&bav=on.2,or.r_gc.r_pw.&fp=15452f08c0b66d7&biw=1296&bih=603";

$cmds["google"] = createGetCmd($goorl);
$cmds["find"] = $cmds["google"];
$cmds["finde"] = $cmds["google"];
$cmds["?"] = $cmds["google"];
$cmds["bild"] = createGetCmd("http://www.google.ch/images?hl=de&q=<1>&meta=on");
$cmds["news"] = createGetCmd("http://www.google.ch/news?hl=de&q=<1>&meta=on");
$cmds["maps"] = createGetCmd("http://maps.google.ch/maps?q=<1>");

$cmds["en"] = createGetCmd("http://dict.leo.org/?lang=de&spellToler=std&search=<1>");
$cmds["leo"] = $cmds["en"];
$cmds["fr"] = createGetCmd("http://dict.leo.org/?lp=frde&spellToler=std&search=<1>");
$cmds["es"] = createGetCmd("http://dict.leo.org/?lp=esde&spellToler=std&search=<1>");
$cmds["it"] = createGetCmd("http://dict.leo.org/?lp=itde&spellToler=std&search=<1>");

$cmds["wiki"] = createGetCmd("http://de.wikipedia.org/wiki/Spezial:Suche?search=<1>");
$cmds["wikipedia"] = $cmds["wiki"];

/////
// NAVIGATION

$cmds["sbb"] = createPostCmd("http://fahrplan.sbb.ch/bin/query.exe/dn?", "http://fahrplan.sbb.ch", array (
"queryPageDisplayed" => "yes",
"REQ0HafasSkipLongChanges" => "0",
"REQ0JourneyStops1.0A" => "1",
"REQ0JourneyStopsS0A" => "7",
"REQ0JourneyStopsZ0A" => "7",
"REQ0JourneyStopsS0ID",
"REQ0JourneyStopsZ0ID",
"REQ0HafasMaxChangeTime" => "120",
"Z" => "",
"S" => "",
"REQ0JourneyStops1.0G",
"wDayExt0" => "Mo|Di|Mi|Do|Fr|Sa|So",
"REQ0HafasSearchForw" => "<5>", // ankunft=0 abfahrt=1
"start" => "&#187; Verbindung suchen",
"REQ0JourneyStopsS0G" => "<1>",
"REQ0JourneyStopsZ0G" => "<2>",
"REQ0JourneyDate" => "<3>",
"REQ0JourneyTime" => "<4>"
));
$cmds["zug"] = $cmds["sbb"];
$cmds["bus"] = $cmds["sbb"];
$cmds["tram"] = $cmds["sbb"];
$cmds["�v"] = $cmds["sbb"];

$cmds["route"] = createGetCmd("http://www.viamichelin.de/viamichelin/deu/dyn/controller/ItiWGPerformPage?E_wg=210506008kS6J506007214242232805ITIWG2i11133deu0026110h10041010041010010010072006007039.004-1.00110001001001001001001003deu011011&pim=true&strStartAddress=<1>&strStartCP=&strStartCity=<2>&strStartCityCountry=<5>&strDestAddress=<3>&strDestCP=&strDestCity=<4>&strDestCityCountry=<6>&strStep1Address=&strStep1CP=&strStep1City=&strStep1CityCountry=EUR&strStep3Address=&strStep3CP=&strStep3City=&strStep3CityCountry=EUR&strStep2Address=&strStep2CP=&strStep2City=&strStep2CityCountry=EUR&dtmDeparture=07%2F01%2F2006&intItineraryType=1&intOneCountryCheck=true&unit=km&vh=CAR&conso=6&carbCost=1.00&devise=1.0%7CEUR&devise2=Andere&image.x=37&image.y=12");
$cmds["weg"] = $cmds["route"];

$cmds["wo"] = createGetCmd("http://map.search.ch/<1>/<2>");
$cmds["ort"] = $cmds["wo"];
$cmds["karte"] = $cmds["wo"];
$cmds["plan"] = $cmds["wo"];

$cmds["tel"] = createGetCmd("http://tel.search.ch/result.html?was=<1>&wo=<2>&privat=1&firma=1&search=Suchen");

/////
// WETTER

$cmds["wetter"] = createGetCmd("http://www.meteoschweiz.admin.ch/web/de/wetter/detailprognose/lokalprognose.html?language=de&plz=<1>");
$links["meteo"] = createLink("http://meteo.sf.tv/sfmeteo/");

$links["radar"] = createLink("http://www.meteoschweiz.admin.ch//web/de/wetter/aktuelles_wetter/radarbild.Par.0004.Image.gif");
$links["regen"] = $links["radar"];

$cmds["cam"] = createPostCmd("http://www.swisswebcams.ch/deutsch/search.php", "http://www.swisswebcams.ch", array("sbgr" => "<1>"));
$cmds["webcam"] = $cmds["cam"];

$cmds["snow"] = createGetCmd("http://snow.search.ch/index.php?sc=rl&rn=<1>&search_button=Suche+Starten");
$cmds["schnee"] = $cmds["snow"];



/////
// HANDEL

$cmds["ricardo"] = createGetCmd("http://www.ricardo.ch/search/search.asp?txtSearch=<1>");
$cmds["ric"] = $cmds["ricardo"];

$cmds["ebay"] = createGetCmd("http://search.ebay.ch/search/search.dll?cgiurl=http%3A%2F%2Fcgi.ebay.ch%2Fws%2F&fkr=1&from=R8&satitle=<1>");

$cmds["amazon"] = createPostCmd("http://www.amazon.de/exec/obidos/search-handle-form", "http://www.amazon.de", array("field-keywords" => "<1>"));
$cmds["buch"] = $cmds["amazon"];
$cmds["dvd"] = $cmds["amazon"];
$cmds["cd"] = $cmds["amazon"];

$cmds["b�rse"] = createGetCmd("http://www.swissquote.ch/cgi-bin/redirector/go?cb&<1>&self&d");
$cmds["boerse"] = $cmds["b�rse"];

$cmds["wechselkurs"] = createPostCmd("http://www.oanda.com/convert/classic?lang=de", "http://www.oanda.com", array("value" => "<1>", "exch" => "<2>", "expr" => "<3>"));
$cmds["kurs"] = $cmds["wechselkurs"];
$cmds["geld"] = $cmds["wechselkurs"];

$cmds["gelbe"] = createGetCmd("http://www.directories.ch/gelbeseiten/base.aspx?do=search&searchtype=adr_simple&language=de&page=1&name=<1>&geo=<2>");
$cmds["gelbeExt"] = createGetCmd("http://www.directories.ch/gelbeseiten/base.aspx?do=backToSearchForms&searchtype=adr_extended&language=de&page=1&name=<1>&geo=<2>");

$cmds["vergleich"] = createGetCmd("http://www.preisvergleich.ch/suchergebnis.php?query=<1>&stype=1");
$cmds["vgl"] = $cmds["vergleich"];

/////
// UNTERHALTUNG

$links["tvjetzt"] = createLink("http://www.teleboy.ch/programm/jetzt_im_tv.php?showtime=jetzt&stations=top&order_by=label");
$links["tv30"] = createLink("http://www.teleboy.ch/programm/jetzt_im_tv.php?showtime=30&stations=top&order_by=label");
$links["tv8"] = createLink("http://www.teleboy.ch/programm/jetzt_im_tv.php?showtime=primetime&stations=top&order_by=label");
$links["tv9"] = createLink("http://www.teleboy.ch/programm/jetzt_im_tv.php?showtime=primetime2&stations=top&order_by=label");
$links["tv10"] = createLink("http://www.teleboy.ch/programm/jetzt_im_tv.php?showtime=latenight&stations=top&order_by=label");
$links["tv11"] = createLink("http://www.teleboy.ch/programm/jetzt_im_tv.php?showtime=night&stations=top&order_by=label");
$links["tvnow"] = $links["tvjetzt"];
$links["tvj"] = $links["tvjetzt"];
$links["tv20"] = $links["tv8"];
$links["tv20:15"] = $links["tv8"];
$links["tv2015"] = $links["tv8"];
$links["tv21"] = $links["tv21"];
$links["tv21:15"] = $links["tv21"];
$links["tv2115"] = $links["tv21"];
$links["tv22"] = $links["tv10"];
$links["tv22:15"] = $links["tv10"];
$links["tv2215"] = $links["tv10"];
$links["tv23"] = $links["tv11"];
$links["tv23:15"] = $links["tv11"];
$links["tv2315"] = $links["tv11"];

$cmds["tv"] = createGetCmd("http://www.teleboy.ch/programm/process.php?fuzzy=<1>");

$links["sf"] = createLink("http://www.sf.tv/var/videos.php");

$cmds["kinoin"] = createGetCmd("http://cineman.ch/kinoprogramm/process.php?zip=<1>");
$cmds["kinowo"] = $cmds["kinoin"];
$cmds["kino"] = createGetCmd("http://cineman.ch/search/global/index.php?search=<1>&searchall=yes");

$cmds["trailer"] = createGetCmd("http://www.apple.com/search/downloads/?q=<1>");
$cmds["trailers"] = createLink("http://www.apple.com/trailers/");
$cmds["film"] = $cmds["trailer"];
$cmds["filme"] = $cmds["trailers"];

$cmds["yt"] = createGetCmd("http://youtube.com/results?search_query=<1>&search=");
$cmds["ytube"] = $cmds["yt"];
$cmds["youtube"] = $cmds["yt"];

$links["ytmr"] = createLink("http://youtube.com/browse?s=mr&t=a&c=0&l=");
$links["ytmv"] = createLink("http://youtube.com/browse?s=mp&t=a&c=0&l=");
$links["yttr"] = createLink("http://youtube.com/browse?s=tr&t=a&c=0&l=");
$links["ytmd"] = createLink("http://youtube.com/browse?s=md&t=a&c=0&l=");

$links["ytmvt"] = createLink("http://youtube.com/browse?s=mp&t=t&c=0&l=");
$links["yttrt"] = createLink("http://youtube.com/browse?s=tr&t=t&c=0&l=");
$links["ytmdt"] = createLink("http://youtube.com/browse?s=md&t=t&c=0&l=");

$links["ytmvw"] = createLink("http://youtube.com/browse?s=mp&t=w&c=0&l=");
$links["yttrw"] = createLink("http://youtube.com/browse?s=tr&t=w&c=0&l=");
$links["ytmdw"] = createLink("http://youtube.com/browse?s=md&t=w&c=0&l=");

$links["ytmvm"] = createLink("http://youtube.com/browse?s=mp&t=m&c=0&l=");
$links["yttrm"] = createLink("http://youtube.com/browse?s=tr&t=m&c=0&l=");
$links["ytmdm"] = createLink("http://youtube.com/browse?s=md&t=m&c=0&l=");

$cmds["imdb"] = createGetCmd("http://www.imdb.com/find?q=<1>;s=all");

/////
// META

$links["help"] = createLink("index.php?page=help");
$links["hilfe"] = $links["help"];
$links["def"] = createLink("index.php?page=user");
$links["define"] = $links["def"];


/////
// User Links

require_once("user/_urls.php");

?>