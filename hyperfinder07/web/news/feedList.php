<?php

// Das Array $feedsByUrl enthält verschiedene Arrays mit Newsfeeds, sortiert nach der URL von der sie stammen.
// Jedes dieser Arrays besitzt den key "name", unter dem der Name der Gruppe gespeichert wird.
// Die Arrays $feedsByTopic, $podcasts und $swissnews enthalten newsfeeds sortiert nach Thema oder nur Podcasts etc.
// Die Klasse Newsfeed enthält Meta-Informationen zu einem newsfeed.

// !! Nicht vergessen !! diese Variablen müssen in initFeedsByUrl() als global definiert sein!
$TOPIC_HEADLINES = "headlines";
$TOPIC_SCHWEIZ = "schweiz";
$TOPIC_AUSLAND = "ausland";
$TOPIC_BG = "hintergrund";
$TOPIC_GELD = "geld";
$TOPIC_SPORT = "sport";
$TOPIC_KULTUR = "kultur";
$TOPIC_HEALTH = "health";
$TOPIC_TECH = "tech";
$TOPIC_AUTO = "auto";
$TOPIC_KLATSCH = "klatsch";
$TOPIC_COMICS = "comics";

// enthält alle topics und legt die reihenfolge fest
$topics = array(
	1 => $TOPIC_HEADLINES, 
	2 => $TOPIC_SCHWEIZ, 
	3 => $TOPIC_AUSLAND, 
	4 => $TOPIC_BG, 
	5 => $TOPIC_GELD, 
	6 => $TOPIC_SPORT, 
	7 => $TOPIC_KULTUR,
	8 => $TOPIC_HEALTH, 
	9 => $TOPIC_TECH, 
	10 => $TOPIC_AUTO,
	11 => $TOPIC_KLATSCH,
	12 => $TOPIC_COMICS
);

// enthält alle topic names nach id
$topicNames = array(
	$TOPIC_HEADLINES => "Schlagzeilen",
	$TOPIC_SCHWEIZ => "Schweiz",
	$TOPIC_AUSLAND => "International",
	$TOPIC_BG => "Hintergründe",
	$TOPIC_GELD => "Geld und Wirtschaft",
	$TOPIC_SPORT => "Sport",
	$TOPIC_KULTUR => "Kultur", 
	$TOPIC_HEALTH => "Gesundheit", 
	$TOPIC_TECH => "Wissen und Technik", 
	$TOPIC_AUTO => "Auto",
	$TOPIC_KLATSCH => "Unterhaltung",
	$TOPIC_COMICS => "Comics"
);

class Newsfeed {

	// die URL
	var $url;
	// die Überschrift
	var $text;
	// Thema
	var $topic;

	// die Höhe des DIV mit den News
	var $height;
	// die Anzahl gleichzeitig dargestellter items.
	var $nofitems;
	// (y|n) default: n. ein Newsfeed im Atom format
	var $atom;
	// (y|n), default: y. gibt an, ob summary angezeigt werden soll oder nicht (nur Atom)
	var $showSummary = "y";
	// if the summary is actually an image tag, don't convert it with htmlentities()
	var $htmlentities = true;
	// Millisekunden bis zur nächsten Nachricht gewechselt wird.
	var $tickerTempo;
	
	// ("y"|"n"). Falls = "y" wird der feed mit utf8_decode konvertiert. 
	// Dieses flag wird aber nur berücksichtig, wenn im feed selber kein encoding angegeben ist
	var $utf8;
	
	// weltwoche has audio enclosers with relative links
	var $enclosureURLPrefix;
	
	var $googleNews;

	function Newsfeed($url, $text, $topic, $height, $nofitems, $tempo, $utf8) {
		$this->url = $url;
		$this->text = $text;
		$this->topic = $topic;
		$this->height = $height;
		$this->nofitems = $nofitems;
		$this->tickerTempo = $tempo;
		$this->utf8 = $utf8;
	}

	function makeAtom($showSummary) {
		$this->atom = "y";
		$this->showSummary = $showSummary;
	}
}

// Erstellt einen Newsfeed im Atom format
function createAtomFeed($url, $text, $topic, $height, $nofitems, $tempo, $utf8, $showSummary) {
	$atomfeed = new Newsfeed($url, $text, $topic, $height, $nofitems, $tempo, $utf8);
	$atomfeed->makeAtom($showSummary);
	return $atomfeed;
}

function createWeltwoche($url, $text, $topic, $height, $nofitems, $tempo, $utf8) {
	$feed = new Newsfeed($url, $text, $topic, $height, $nofitems, $tempo, $utf8);
	$feed->enclosureURLPrefix = "http://www.weltwoche.ch/audio/mp3/";
	return $feed;
}

/////
// Init newsfeed arrays

function initFeedsByUrl() {

	global $TOPIC_HEADLINES, 
		$TOPIC_SCHWEIZ, 
		$TOPIC_AUSLAND, 
		$TOPIC_BG, 
		$TOPIC_GELD, 
		$TOPIC_SPORT, 
		$TOPIC_KULTUR,
		$TOPIC_HEALTH,  
		$TOPIC_TECH, 
		$TOPIC_AUTO, 
		$TOPIC_KLATSCH, 
		$TOPIC_COMICS;


	/////
	// Google

	$google[1] = new Newsfeed("http://news.google.ch/?output=rss", "Google News", $TOPIC_HEADLINES, 264, 1, null, "y");	
	$google[1]->googleNews = "y";
	$google[1]->htmlentities = false;
	$google[2] = new Newsfeed("http://news.google.ch/?output=rss&topic=w", "Google News - International", $TOPIC_AUSLAND, 264, 1, null, "y");	
	$google[2]->googleNews = "y";
	$google[2]->htmlentities = false;
	$google[3] = new Newsfeed("http://news.google.ch/?output=rss&topic=n", "Google News - Schweiz", $TOPIC_SCHWEIZ, 264, 1, null, "y");	
	$google[3]->googleNews = "y";
	$google[3]->htmlentities = false;
	$google[4] = new Newsfeed("http://news.google.ch/?output=rss&topic=b", "Google News - Wirtschaft", $TOPIC_GELD, 264, 1, null, "y");	
	$google[4]->googleNews = "y";
	$google[4]->htmlentities = false;
	$google[5] = new Newsfeed("http://news.google.ch/?output=rss&topic=t", "Google News - Wissen/Technik", $TOPIC_TECH, 264, 1, null, "y");	
	$google[5]->googleNews = "y";
	$google[5]->htmlentities = false;
	$google[6] = new Newsfeed("http://news.google.ch/?output=rss&topic=s", "Google News - Sport", $TOPIC_SPORT, 264, 1, null, "y");	
	$google[6]->googleNews = "y";
	$google[6]->htmlentities = false;
	$google[7] = new Newsfeed("http://news.google.ch/?output=rss&topic=e", "Google News - Unterhaltung", $TOPIC_KLATSCH, 264, 1, null, "y");	
	$google[7]->googleNews = "y";
	$google[7]->htmlentities = false;
	$google[8] = new Newsfeed("http://news.google.ch/?output=rss&topic=m", "Google News - Gesundheit", $TOPIC_HEALTH, 264, 1, null, "y");	
	$google[8]->googleNews = "y";
	$google[8]->htmlentities = false;
	
	$google["name"] = "google.ch";
	$feedsByUrl["google"] = $google;

	
	///////
	// NZZ

	$nzz[0] = new Newsfeed("http://nzz.ch/nachrichten/Startseite?rss=true", "NZZ - Topthemen", $TOPIC_HEADLINES, 60, 1, null, "n");
	$nzz[1] = new Newsfeed("http://nzz.ch/nachrichten/International?rss=true", "NZZ - International", $TOPIC_AUSLAND, 60, 1, null, "n");
	$nzz[2] = new Newsfeed("http://nzz.ch/nachrichten/Schweiz?rss=true", "NZZ - Schweiz", $TOPIC_SCHWEIZ, 60, 1, null, "n");
	$nzz[3] = new Newsfeed("http://nzz.ch/nachrichten/Wirtschaft/aktuell?rss=true", "NZZ - Wirtschaft", $TOPIC_GELD, 60, 1, null, "n");
	$nzz[4] = new Newsfeed("http://nzz.ch/nachrichten/Wirtschaft/Boersen_und_Maerkte?rss=true", "NZZ - Börsen und Märkte", $TOPIC_GELD, 60, 1, null, "n");
	$nzz[5] = new Newsfeed("http://nzz.ch/nachrichten/Zuerich?rss=true", "NZZ - Zürich", null, 60, 1, null, "n");
	$nzz[6] = new Newsfeed("http://nzz.ch/nachrichten/Sport?rss=true", "NZZ - Sport", $TOPIC_SPORT, 60, 1, null, "n");
	$nzz[7] = new Newsfeed("http://nzz.ch/nachrichten/Panorama?rss=true", "NZZ - Panorama", $TOPIC_KLATSCH, 80, 1, null, "n");

	$nzz["name"] = "nzz.ch";
	$feedsByUrl["a1_nzz"] = $nzz;


	/////
	// Tagesanzeiger

	$tagi[0] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/news/rss2/index.xml", "Tagesanzeiger - Titelseite", $TOPIC_HEADLINES, 100, 1, null, "y");
	$tagi[1] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/news/rss2/schweiz/index.xml", "Tagesanzeiger - Schweiz", $TOPIC_SCHWEIZ, 100, 1, null, "y");
	$tagi[2] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/news/rss2/ausland/index.xml", "Tagesanzeiger - Ausland", $TOPIC_AUSLAND, 100, 1, null, "y");
	$tagi[3] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/news/rss2/zuerich/index.xml", "Tagesanzeiger - Zürich", null, 100, 1, null, "y");
	$tagi[4] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/news/rss2/wirtschaft/index.xml", "Tagesanzeiger - Wirtschaft", $TOPIC_GELD, 100, 1, null, "y");
	$tagi[5] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/news/rss2/sport/index.xml", "Tagesanzeiger - Sport", $TOPIC_SPORT, 100, 1, null, "y");
	$tagi[6] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/news/rss2/vermischtes/index.xml", "Tagesanzeiger - Vermischtes", $TOPIC_KLATSCH, 100, 1, null, "y");
	$tagi[7] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/geld/rss2/index.xml", "Tagesanzeiger - Geld", $TOPIC_GELD, 120, 1, null, "y");
	$tagi[8] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/digital/rss2/index.xml", "Tagesanzeiger - Digital", $TOPIC_TECH, 120, 1, null, "y");
	$tagi[9] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/auto/rss2/index.xml", "Tagesanzeiger - Auto", $TOPIC_AUTO, 120, 1, null, "y");
	$tagi[10] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/reisen/rss2/index.xml", "Tagesanzeiger - Reisen", $TOPIC_AUSLAND, 120, 1, null, "y");
	$tagi[11] = new Newsfeed("http://www.tagesanzeiger.ch/dyn/wissen/rss2/index.xml", "Tagesanzeiger - Wissen", $TOPIC_TECH, 120, 1, null, "y");

	$tagi["name"] = "tagesanzeiger.ch";
	$feedsByUrl["a2_tagi"] = $tagi;


	/////
	// Blick (siehe http://www.blick.ch/service/rss/artikel28697)

	$blick[0] = new Newsfeed("http://www.blick.ch/news/rss.xml", "Blick - News", $TOPIC_HEADLINES, 100, 1, null, "n");
	$blick[1] = new Newsfeed("http://www.blick.ch/news/schweiz/rss.xml", "Blick - News/Schweiz", $TOPIC_SCHWEIZ, 100, 1, null, "n");
	$blick[2] = new Newsfeed("http://www.blick.ch/news/ausland/rss.xml", "Blick - News/Ausland", $TOPIC_AUSLAND, 100, 1, null, "n");
	$blick[3] = new Newsfeed("http://www.blick.ch/news/wirtschaft/rss.xml", "Blick - News/Wirtschaft", $TOPIC_GELD, 100, 1, null, "n");
	$blick[4] = new Newsfeed("http://www.blick.ch/news/nahost/rss.xml", "Blick - News/Nahost", $TOPIC_AUSLAND, 100, 1, null, "n");
	$blick[5] = new Newsfeed("http://www.blick.ch/news/irak/rss.xml", "Blick - News/Irak", $TOPIC_AUSLAND, 100, 1, null, "n");
	$blick[6] = new Newsfeed("http://www.blick.ch/news/tierwelt/rss.xml", "Blick - Tierwelt", null, 100, 1, null, "n");
	$blick[7] = new Newsfeed("http://www.blick.ch/news/wissenschaftundtechnik/rss.xml", "Blick - Wissenschaft und Technik", null, 100, 1, null, "n");
	$blick[8] = new Newsfeed("http://www.blick.ch/news/liebeundsex/rss.xml", "Blick - Liebe & Sex", null, 100, 1, null, "n");
	
	$blick[10] = new Newsfeed("http://www.blick.ch/sport/rss.xml", "Blick - Sport", null, 100, 1, null, "n");
	$blick[11] = new Newsfeed("http://www.blick.ch/sport/fussball/rss.xml", "Blick - Sport/Fussball", null, 100, 1, null, "n");
	$blick[12] = new Newsfeed("http://www.blick.ch/sport/eishockey/rss.xml", "Blick - Sport/Eishockey", null, 100, 1, null, "n");
	//$blick[13] = new Newsfeed("http://www.blick.ch/sport/tennis/rss.xml", "Blick - Sport/Tennis", null, 100, 1, null, "n");
	//$blick[14] = new Newsfeed("http://www.blick.ch/sport/ski/rss.xml", "Blick - Sport/Ski", null, 100, 1, null, "n");
	$blick[15] = new Newsfeed("http://www.blick.ch/sport/formel1/rss.xml", "Blick - Sport/Formel 1", null, 100, 1, null, "n");
	$blick[16] = new Newsfeed("http://www.blick.ch/sport/leichtathletik/rss.xml", "Blick - Sport/Leichtathletik", null, 100, 1, null, "n");
	//$blick[17] = new Newsfeed("http://www.blick.ch/sport/rad/rss.xml", "Blick - Sport/Rad", null, 100, 1, null, "n");
	
	$blick[20] = new Newsfeed("http://www.blick.ch/showbiz/rss.xml", "Blick - Showbiz", null, 100, 1, null, "n");
	$blick[21] = new Newsfeed("http://www.blick.ch/lifestyle/rss.xml", "Blick - Lifestyle", null, 100, 1, null, "n");
	$blick[22] = new Newsfeed("http://www.blick.ch/auto/rss.xml", "Blick - Auto", $TOPIC_AUTO, 100, 1, null, "n");
	$blick[23] = new Newsfeed("http://www.blick.ch/games/rss.xml", "Blick - Games", null, 100, 1, null, "n");
	
	$blick["name"] = "blick.ch";
	$feedsByUrl["a3_blick"] = $blick;


	////////////
	// Drs.ch (siehe http://www.drs.ch/podcasting.html)

	$drs[1] = new Newsfeed("http://pod.drs.ch/echo_der_zeit_mpx.xml", "Radio DRS - Echo der Zeit", $TOPIC_HEADLINES, 180, 1, 10000, "n");
	$drs[2] = new Newsfeed("http://pod.drs.ch/heutemorgen_mpx.xml", "Radio DRS - HeuteMorgen", $TOPIC_HEADLINES, 168, 1, 10000, "n");
	$drs[3] = new Newsfeed("http://pod.drs.ch/international_mpx.xml", "Radio DRS - International", $TOPIC_AUSLAND, 208, 1, 10000, "n");
	$drs[4] = new Newsfeed("http://pod.drs.ch/rendez-vous_mpx.xml", "Radio DRS - Rendez Vous", null, 168, 1, 10000, "n");
	$drs[5] = new Newsfeed("http://pod.drs.ch/samstagsrundschau_mpx.xml", "Radio DRS - Samstagsrundschau", $TOPIC_HEADLINES, 168, 1, 10000, "n");
	$drs[6] = new Newsfeed("http://pod.drs.ch/tagesgesprach_mpx.xml", "Radio DRS - Tagesgespräch", null, 168, 1, 10000, "n");
	$drs[7] = new Newsfeed("http://pod.drs.ch/trend_mpx.xml", "Radio DRS - Trend Plus", null, 168, 1, 10000, "n");
	
	$drs[10] = new Newsfeed("http://pod.drs.ch/doppelpunkt_mpx.xml", "Radio DRS 1 - Doppelpunkt", null, 188, 1, 10000, "n");
	$drs[11] = new Newsfeed("http://pod.drs.ch/espresso_mpx.xml", "Radio DRS 1 - Espresso", null, 188, 1, 10000, "n");
	$drs[12] = new Newsfeed("http://pod.drs.ch/kinderradio_mpx.xml", "Radio DRS 1 - Kinderradio", null, 120, 1, 10000, "n");
	$drs[13] = new Newsfeed("http://pod.drs.ch/mailbox_mpx.xml", "Radio DRS 1 - Mailbox", null, 168, 1, 10000, "n");
	$drs[14] = new Newsfeed("http://pod.drs.ch/personlich_mpx.xml", "Radio DRS 1 - Persönlich", null, 188, 1, 10000, "n");
	$drs[15] = new Newsfeed("http://pod.drs.ch/ratgeber_mpx.xml", "Radio DRS 1 - Ratgeber", null, 168, 1, 10000, "n");
	$drs[16] = new Newsfeed("http://pod.drs.ch/siesta_mpx.xml", "Radio DRS 1 - Siesta", null, 168, 1, 10000, "n");

	$drs[21] = new Newsfeed("http://pod.drs.ch/drs2aktuell_mpx.xml", "Radio DRS 2 - aktuell", $TOPIC_HEADLINES, 160, 1, 10000, "n");
	$drs[22] = new Newsfeed("http://pod.drs.ch/atlas_mpx.xml", "Radio DRS 2 - Atlas", null, 188, 1, 10000, "n");
	$drs[23] = new Newsfeed("http://pod.drs.ch/film_mpx.xml", "Radio DRS 2 - Film", $TOPIC_KULTUR, 188, 1, 10000, "n");
	$drs[24] = new Newsfeed("http://pod.drs.ch/kontext_mpx.xml", "Radio DRS 2 - Kontext", null, 168, 1, 10000, "n");
	$drs[25] = new Newsfeed("http://pod.drs.ch/perspektiven_mpx.xml", "Radio DRS 2 - Perspektiven", $TOPIC_HG, 208, 1, 10000, "n");
	$drs[26] = new Newsfeed("http://pod.drs.ch/reflexe_mpx.xml", "Radio DRS 2 - Reflexe", $TOPIC_HG, 188, 1, 10000, "n");
	$drs[27] = new Newsfeed("http://pod.drs.ch/wissenschaft_drs_2_mpx.xml", "Radio DRS 2 - Wissenschaft", $TOPIC_TECH, 168, 1, 10000, "n");
	
	$drs[31] = new Newsfeed("http://pod.drs.ch/digital_plus_mpx.xml", "Radio DRS 3 - Digital Plus", $TOPIC_TECH, 208, 1, 10000, "n");
	$drs[32] = new Newsfeed("http://pod.drs.ch/focus_-_die_talkshow_mpx.xml", "Radio DRS 3 - Focus", null, 208, 1, 10000, "n");
	$drs[33] = new Newsfeed("http://pod.drs.ch/input_mpx.xml", "Radio DRS 3 - Input", null, 168, 1, 10000, "n");
	$drs[34] = new Newsfeed("http://pod.drs.ch/nachtwach_mpx.xml", "Radio DRS 3 - nachtwach", null, 188, 1, 10000, "n");
	$drs[35] = new Newsfeed("http://pod.drs.ch/satire_peter_schneider_mpx.xml", "Radio DRS 3 - Peter Schneider Plus", null, 80, 1, 10000, "n");
	
	$drs[40] = new Newsfeed("http://www.klangarchitekten.com/podcasts/dircaster.php", "VIRUS - Täglich Neu", null, 80, 1, 10000, "n");
	
	$drs[51] = new Newsfeed("http://services.drs.ch/xml/horspiel_drs_1_rss.xml", "Hörspiel DRS 1", null, 220, 1, 10000, "n");
	$drs[52] = new Newsfeed("http://services.drs.ch/xml/horspiel_drs_2_rss.xml", "Hörspiel DRS 2", null, 220, 1, 10000, "n");
	$drs[53] = new Newsfeed("http://services.drs.ch/xml/614C7788-BE1D-4827-B28640E1FD28426C_rss.xml", "Hitparade", null, 160, 1, 10000, "n");
	$drs[54] = new Newsfeed("http://services.drs.ch/xml/madame_etoiles_wochenhoroskop_rss.xml", "Madamme Etoiles Wochenhoroskop", null, 180, 1, 10000, "n");
	$drs[55] = new Newsfeed("http://services.drs.ch/xml/philip_maloney_rss.xml", "Philip Maloney", null, 160, 1, 10000, "n");
	$drs[56] = new Newsfeed("http://services.drs.ch/xml/uf_u_dervo_rss.xml", "Radio DRS - Uf u dervo", null, 220, 1, 10000, "n");
	$drs[57] = new Newsfeed("http://services.drs.ch/xml/06C6B971-EBA3-42F1-B0DB9BB1A8224D87_rss.xml", "Radio DRS - Wirtschaft", $TOPIC_GELD, 160, 1, 10000, "n");
	$drs[58] = new Newsfeed("http://services.drs.ch/xml/zweierleier_zytlupe_rss.xml", "Radio DRS - Zweierleier/Zytlupe", null, 140, 1, 10000, "n");

	$drs["name"] = "drs.ch";
	$feedsByUrl["a4_drs"] = $drs;

	/////
	// News.ch (siehe http://www.news.ch/themen/)

	$news[0] = new Newsfeed("http://rss.news.ch/rss.xml", "news.ch - Letzte Meldungen", $TOPIC_HEADLINES, 80, 1, null, "n");
	$news[1] = new Newsfeed("http://rss.news.ch/rubrik_rss/21.xml", "news.ch - Wetter", $TOPIC_HEADLINES, 80, 1, null, "n");
	$news[2] = new Newsfeed("http://rss.news.ch/rubrik_rss/303.xml", "news.ch - Unwetter", $TOPIC_HEADLINES, 80, 1, null, "n");
	$news[3] = new Newsfeed("http://rss.news.ch/rubrik_rss/28.xml", "news.ch - News - Front", $TOPIC_HEADLINES, 80, 1, null, "n");
	$news[4] = new Newsfeed("http://rss.news.ch/rubrik_rss/306.xml", "news.ch - News - Unglücksfälle", $TOPIC_HEADLINES, 80, 1, null, "n");
	$news[5] = new Newsfeed("http://rss.news.ch/rubrik_rss/307.xml", "news.ch - News - Verbrechen", $TOPIC_HEADLINES, 80, 1, null, "n");
	
	$news[10] = new Newsfeed("http://rss.news.ch/rubrik_rss/22.xml", "news.ch - Inland", $TOPIC_SCHWEIZ, 80, 1, null, "n");
	$news[11] = new Newsfeed("http://rss.news.ch/rubrik_rss/293.xml", "news.ch - Inland - Abstimmungen & Wahlen", $TOPIC_SCHWEIZ, 80, 1, null, "n");
	$news[12] = new Newsfeed("http://rss.news.ch/rubrik_rss/582.xml", "news.ch - Inland - Bundesrat", $TOPIC_SCHWEIZ, 80, 1, null, "n");
	$news[13] = new Newsfeed("http://rss.news.ch/rubrik_rss/584.xml", "news.ch - Inland - Parlament", $TOPIC_SCHWEIZ, 80, 1, null, "n");
	$news[14] = new Newsfeed("http://rss.news.ch/rubrik_rss/583.xml", "news.ch - Inland - Armee", $TOPIC_SCHWEIZ, 80, 1, null, "n");
	
	$news[20] = new Newsfeed("http://rss.news.ch/rubrik_rss/20.xml", "news.ch - Ausland", $TOPIC_AUSLAND, 80, 1, null, "n");
	$news[21] = new Newsfeed("http://rss.news.ch/rubrik_rss/292.xml", "news.ch - Ausland - EU Politik", $TOPIC_AUSLAND, 80, 1, null, "n");
	$news[22] = new Newsfeed("http://rss.news.ch/rubrik_rss/291.xml", "news.ch - Ausland - Wahlen", $TOPIC_AUSLAND, 80, 1, null, "n");
	$news[23] = new Newsfeed("http://rss.news.ch/rubrik_rss/289.xml", "news.ch - Ausland - Nahost", $TOPIC_AUSLAND, 80, 1, null, "n");
	$news[24] = new Newsfeed("http://rss.news.ch/rubrik_rss/290.xml", "news.ch - Ausland - Irak", $TOPIC_AUSLAND, 80, 1, null, "n");
	$news[25] = new Newsfeed("http://rss.news.ch/rubrik_rss/200.xml", "news.ch - Ausland - Krieg/Terror", $TOPIC_AUSLAND, 80, 1, null, "n");
	$news[26] = new Newsfeed("http://rss.news.ch/rubrik_rss/18.xml", "news.ch - Reisen", $TOPIC_AUSLAND, 80, 1, null, "n");
		
	$news[40] = new Newsfeed("http://rss.news.ch/rubrik_rss/1.xml", "news.ch - Wirtschaft", $TOPIC_GELD, 80, 1, null, "n");
	$news[41] = new Newsfeed("http://rss.news.ch/rubrik_rss/23.xml", "news.ch - Wirtschaft - Arbeitsmarkt", $TOPIC_GELD, 80, 1, null, "n");
	$news[42] = new Newsfeed("http://rss.news.ch/rubrik_rss/25.xml", "news.ch - Wirtschaft - Börse", $TOPIC_GELD, 80, 1, null, "n");
	$news[43] = new Newsfeed("http://rss.news.ch/rubrik_rss/41.xml", "news.ch - Wirtschaft - Finanzplatz", $TOPIC_GELD, 80, 1, null, "n");
	$news[44] = new Newsfeed("http://rss.news.ch/rubrik_rss/43.xml", "news.ch - Wirtschaft - Werbung", $TOPIC_GELD, 80, 1, null, "n");
	$news[45] = new Newsfeed("http://rss.news.ch/rubrik_rss/60.xml", "news.ch - Wirtschaft - Versicherungen", $TOPIC_GELD, 80, 1, null, "n");
	$news[46] = new Newsfeed("http://rss.news.ch/rubrik_rss/122.xml", "news.ch - Wirtschaft - Gastronomie", $TOPIC_GELD, 80, 1, null, "n");
	$news[47] = new Newsfeed("http://rss.news.ch/rubrik_rss/180.xml", "news.ch - Wirtschaft - Konkurs", $TOPIC_GELD, 80, 1, null, "n");
	$news[48] = new Newsfeed("http://rss.news.ch/rubrik_rss/294.xml", "news.ch - Wirtschaft - Landwirtschaft", $TOPIC_GELD, 80, 1, null, "n");
	$news[49] = new Newsfeed("http://rss.news.ch/rubrik_rss/330.xml", "news.ch - Wirtschaft - Industrie", $TOPIC_GELD, 80, 1, null, "n");
	
	$news[50] = new Newsfeed("http://rss.news.ch/rubrik_rss/3.xml", "news.ch - Sport", $TOPIC_SPORT, 80, 1, null, "n");
	$news[51] = new Newsfeed("http://rss.news.ch/rubrik_rss/4.xml", "news.ch - Sport - Fussball", $TOPIC_SPORT, 80, 1, null, "n");
	$news[52] = new Newsfeed("http://rss.news.ch/rubrik_rss/15.xml", "news.ch - Sport - Handball", $TOPIC_SPORT, 80, 1, null, "n");
	$news[53] = new Newsfeed("http://rss.news.ch/rubrik_rss/16.xml", "news.ch - Sport - Basketball", $TOPIC_SPORT, 80, 1, null, "n");
	$news[54] = new Newsfeed("http://rss.news.ch/rubrik_rss/53.xml", "news.ch - Sport - Volleyball", $TOPIC_SPORT, 80, 1, null, "n");
	$news[55] = new Newsfeed("http://rss.news.ch/rubrik_rss/31.xml", "news.ch - Sport - Tennis", $TOPIC_SPORT, 80, 1, null, "n");
	$news[56] = new Newsfeed("http://rss.news.ch/rubrik_rss/5.xml", "news.ch - Sport - Eishockey", $TOPIC_SPORT, 80, 1, null, "n");
	$news[57] = new Newsfeed("http://rss.news.ch/rubrik_rss/159.xml", "news.ch - Sport - Wintersport", $TOPIC_SPORT, 80, 1, null, "n");
	$news[58] = new Newsfeed("http://rss.news.ch/rubrik_rss/6.xml", "news.ch - Sport - Ski Alpin", $TOPIC_SPORT, 80, 1, null, "n");
	$news[59] = new Newsfeed("http://rss.news.ch/rubrik_rss/7.xml", "news.ch - Sport - Snowboard", $TOPIC_SPORT, 80, 1, null, "n");
	$news[60] = new Newsfeed("http://rss.news.ch/rubrik_rss/56.xml", "news.ch - Sport - Bob", $TOPIC_SPORT, 80, 1, null, "n");
	$news[61] = new Newsfeed("http://rss.news.ch/rubrik_rss/8.xml", "news.ch - Sport - Leichtathletik", $TOPIC_SPORT, 80, 1, null, "n");
	$news[62] = new Newsfeed("http://rss.news.ch/rubrik_rss/30.xml", "news.ch - Sport - Radsport", $TOPIC_SPORT, 80, 1, null, "n");
	$news[63] = new Newsfeed("http://rss.news.ch/rubrik_rss/52.xml", "news.ch - Sport - Wassersport", $TOPIC_SPORT, 80, 1, null, "n");
	$news[64] = new Newsfeed("http://rss.news.ch/rubrik_rss/50.xml", "news.ch - Sport - Motorsport", $TOPIC_SPORT, 80, 1, null, "n");
	$news[65] = new Newsfeed("http://rss.news.ch/rubrik_rss/158.xml", "news.ch - Sport - Motorrad", $TOPIC_SPORT, 80, 1, null, "n");
	$news[66] = new Newsfeed("http://rss.news.ch/rubrik_rss/54.xml", "news.ch - Sport - Formel 1", $TOPIC_SPORT, 80, 1, null, "n");
	$news[67] = new Newsfeed("http://rss.news.ch/rubrik_rss/51.xml", "news.ch - Sport - Reiten", $TOPIC_SPORT, 80, 1, null, "n");
	$news[68] = new Newsfeed("http://rss.news.ch/rubrik_rss/55.xml", "news.ch - Sport - Boxen", $TOPIC_SPORT, 80, 1, null, "n");
	$news[69] = new Newsfeed("http://rss.news.ch/rubrik_rss/119.xml", "news.ch - Sport - Golf", $TOPIC_SPORT, 80, 1, null, "n");
	$news[70] = new Newsfeed("http://rss.news.ch/rubrik_rss/137.xml", "news.ch - Sport - Schweizer Fussball", $TOPIC_SPORT, 80, 1, null, "n");
	$news[71] = new Newsfeed("http://rss.news.ch/rubrik_rss/138.xml", "news.ch - Sport - Superleague", $TOPIC_SPORT, 80, 1, null, "n");
	$news[72] = new Newsfeed("http://rss.news.ch/rubrik_rss/139.xml", "news.ch - Sport - Challengeleague", $TOPIC_SPORT, 80, 1, null, "n");
	$news[73] = new Newsfeed("http://rss.news.ch/rubrik_rss/140.xml", "news.ch - Sport - Fussballnati", $TOPIC_SPORT, 80, 1, null, "n");
	$news[74] = new Newsfeed("http://rss.news.ch/rubrik_rss/142.xml", "news.ch - Sport - Fussball International", $TOPIC_SPORT, 80, 1, null, "n");
	$news[75] = new Newsfeed("http://rss.news.ch/rubrik_rss/143.xml", "news.ch - Sport - Championsleague", $TOPIC_SPORT, 80, 1, null, "n");
	$news[76] = new Newsfeed("http://rss.news.ch/rubrik_rss/144.xml", "news.ch - Sport - UEFA Cup", $TOPIC_SPORT, 80, 1, null, "n");
	$news[77] = new Newsfeed("http://rss.news.ch/rubrik_rss/146.xml", "news.ch - Sport - Bundesliga", $TOPIC_SPORT, 80, 1, null, "n");
	
	$news[80] = new Newsfeed("http://rss.news.ch/rubrik_rss/2.xml", "news.ch - Kultur", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[81] = new Newsfeed("http://rss.news.ch/rubrik_rss/9.xml", "news.ch - Kultur - Bühne", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[82] = new Newsfeed("http://rss.news.ch/rubrik_rss/332.xml", "news.ch - Kultur - Kunst", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[83] = new Newsfeed("http://rss.news.ch/rubrik_rss/10.xml", "news.ch - Kultur - Musik", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[84] = new Newsfeed("http://rss.news.ch/rubrik_rss/11.xml", "news.ch - Kultur - Kino", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[85] = new Newsfeed("http://rss.news.ch/rubrik_rss/12.xml", "news.ch - Kultur - Ausstellungen", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[86] = new Newsfeed("http://rss.news.ch/rubrik_rss/61.xml", "news.ch - Kultur - Literatur", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[87] = new Newsfeed("http://rss.news.ch/rubrik_rss/17.xml", "news.ch - Bildung", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[88] = new Newsfeed("http://rss.news.ch/rubrik_rss/295.xml", "news.ch - Wissen", $TOPIC_KULTUR, 80, 1, null, "n");
	$news[89] = new Newsfeed("http://rss.news.ch/rubrik_rss/24.xml", "news.ch - Medien", $TOPIC_KULTUR, 80, 1, null, "n");

	$news[100] = new Newsfeed("http://rss.news.ch/rubrik_rss/45.xml", "news.ch - Recht", $TOPIC_BG, 80, 1, null, "n");
	$news[101] = new Newsfeed("http://rss.news.ch/rubrik_rss/46.xml", "news.ch - Gesundheit", $TOPIC_HEALTH, 80, 1, null, "n");
	$news[102] = new Newsfeed("http://rss.news.ch/rubrik_rss/47.xml", "news.ch - Umwelt", $TOPIC_BG, 80, 1, null, "n");
	$news[103] = new Newsfeed("http://rss.news.ch/rubrik_rss/297.xml", "news.ch - Persönlichkeiten", $TOPIC_BG, 80, 1, null, "n");
	
	$news[110] = new Newsfeed("http://rss.news.ch/rubrik_rss/19.xml", "news.ch - Boulevard", $TOPIC_KLATSCH, 80, 1, null, "n");
	$news[111] = new Newsfeed("http://rss.news.ch/rubrik_rss/123.xml", "news.ch - People", $TOPIC_KLATSCH, 80, 1, null, "n");
	$news[112] = new Newsfeed("http://rss.news.ch/rubrik_rss/44.xml", "news.ch - Fashion", $TOPIC_KLATSCH, 80, 1, null, "n");
	$news[113] = new Newsfeed("http://rss.news.ch/rubrik_rss/120.xml", "news.ch - Fernsehen", $TOPIC_KLATSCH, 80, 1, null, "n");
	$news[114] = new Newsfeed("http://rss.news.ch/rubrik_rss/29.xml", "news.ch - Clubbing", $TOPIC_KLATSCH, 80, 1, null, "n");
	$news[115] = new Newsfeed("http://rss.news.ch/rubrik_rss/27.xml", "news.ch - Shopping", $TOPIC_KLATSCH, 80, 1, null, "n");

	$news[190] = new Newsfeed("http://rss.news.ch/rubrik_rss/26.xml", "news.ch - Internet", $TOPIC_TECH, 80, 1, null, "n");
	$news[191] = new Newsfeed("http://rss.news.ch/rubrik_rss/42.xml", "news.ch - Informatik", $TOPIC_TECH, 80, 1, null, "n");
	$news[192] = new Newsfeed("http://rss.news.ch/rubrik_rss/35.xml", "news.ch - Telekommunikation", $TOPIC_TECH, 80, 1, null, "n");
	$news[193] = new Newsfeed("http://rss.news.ch/rubrik_rss/121.xml", "news.ch - Trends", $TOPIC_TECH, 80, 1, null, "n");
	$news[194] = new Newsfeed("http://rss.news.ch/rubrik_rss/48.xml", "news.ch - Energie", $TOPIC_TECH, 80, 1, null, "n");
	$news[195] = new Newsfeed("http://rss.news.ch/rubrik_rss/58.xml", "news.ch - Verkehr", $TOPIC_TECH, 80, 1, null, "n");
	$news[196] = new Newsfeed("http://rss.news.ch/rubrik_rss/36.xml", "news.ch - Baugewerbe", $TOPIC_TECH, 80, 1, null, "n");
	
	$news[200] = new Newsfeed("http://rss.news.ch/rubrik_rss/57.xml", "news.ch - Automobil", $TOPIC_AUTO, 80, 1, null, "n");
	
	$news[220] = new Newsfeed("http://rss.news.ch/rubrik_rss/296.xml", "news.ch - Tiere", null, 80, 1, null, "n");
	
	$news[300] = new Newsfeed("http://rss.news.ch/rubrik_rss/34.xml", "news.ch - Hausinternes", $TOPIC_HEADLINES, 80, 1, null, "n");
	
	$news["name"] = "news.ch";
	$feedsByUrl["a5_news"] = $news;

	
	/////
	// Die Weltwoche

	$weltwoche[0] = createWeltwoche("http://www.weltwoche.ch/rss/rss.xml", "Die Weltwoche", $TOPIC_BG, 80, 1, null, "n");
	$weltwoche[1] = new Newsfeed("http://www.weltwoche.ch/audio/podcast.xml", "Die Weltwoche Audio", $TOPIC_BG, 120, 1, 6000, "y");
	$weltwoche["name"] = "weltwoche.ch";
	$feedsByUrl["weltwoche"] = $weltwoche;

	
	/////
	// Der Spiegel
	
	$spiegel[1] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,,00.xml", "Spiegel Online", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[1]->showSummary = "n"; 
	$spiegel[2] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,20,00.xml", "Spiegel Online - Politik", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[2]->showSummary = "n"; 
	$spiegel[3] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,21,00.xml", "Spiegel Online - Wirtschaft", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[3]->showSummary = "n"; 
	$spiegel[4] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,10,00.xml", "Spiegel Online - Panorama", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[4]->showSummary = "n"; 
	$spiegel[5] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,19,00.xml", "Spiegel Online - Sport", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[5]->showSummary = "n"; 
	$spiegel[6] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,22,00.xml", "Spiegel Online - Kultur", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[6]->showSummary = "n"; 
	$spiegel[7] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,23,00.xml", "Spiegel Online - Netzwelt", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[7]->showSummary = "n"; 
	$spiegel[8] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,24,00.xml", "Spiegel Online - Wissenschaft", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[8]->showSummary = "n"; 
	$spiegel[9] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,140,00.xml", "Spiegel Online - Reise", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[9]->showSummary = "n"; 
	$spiegel[10] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,139,00.xml", "Spiegel Online - Auto", $TOPIC_BG, 80, 3, null, "n");
	$spiegel[10]->showSummary = "n"; 
	
	$spiegel[100] = new Newsfeed("http://www.spiegel.de/schlagzeilen/rss/0,5291,676,00.xml", "Spiegel Online International", $TOPIC_BG, 100, 1, null, "n");
	
	$spiegel["name"] = "spiegel.de";
	$feedsByUrl["spiegel"] = $spiegel;
	

	/////
	// Die Zeit

	$zeit[0] = new Newsfeed("http://newsfeed.zeit.de/", "Die Zeit Online", null, 80, 1, 10000, "n");
	$zeit[1] = new Newsfeed("http://newsfeed.zeit.de/news/index", "Die Zeit Online - Nachrichten", null, 80, 1, 10000, "n");
	$zeit[2] = new Newsfeed("http://newsfeed.zeit.de/video/index", "Die Zeit Online - Video", null, 80, 1, 10000, "n");
	
	$zeit[10] = new Newsfeed("http://newsfeed.zeit.de/deutschland/index", "Die Zeit Online - Deutschland", $TOPIC_AUSLAND, 80, 1, 10000, "n");
	$zeit[11] = new Newsfeed("http://newsfeed.zeit.de/international/index", "Die Zeit Online - International", $TOPIC_AUSLAND, 80, 1, 10000, "n");
	$zeit[12] = new Newsfeed("http://newsfeed.zeit.de/wirtschaft/index", "Die Zeit Online - Wirtschaft", $TOPIC_GELD, 80, 1, 10000, "n");
	$zeit[13] = new Newsfeed("http://newsfeed.zeit.de/wirtschaft/geld/index", "Die Zeit Online - Finanzen", $TOPIC_GELD, 80, 1, 10000, "n");
	$zeit[14] = new Newsfeed("http://newsfeed.zeit.de/wissen/index", "Die Zeit Online - Wissen", $TOPIC_BG, 80, 1, 10000, "n");
	$zeit[15] = new Newsfeed("http://newsfeed.zeit.de/wissen/bildung/index", "Die Zeit Online - Bildung", $TOPIC_BG, 80, 1, 10000, "n");
	$zeit[16] = new Newsfeed("http://newsfeed.zeit.de/gesundheit/index", "Die Zeit Online - Gesundheit", $TOPIC_HEALTH, 80, 1, 10000, "n");
	$zeit[17] = new Newsfeed("http://newsfeed.zeit.de/feuilleton/index", "Die Zeit Online - Feuilleton", $TOPIC_KULTUR, 96, 1, 10000, "n");
	$zeit[18] = new Newsfeed("http://newsfeed.zeit.de/literatur/index", "Die Zeit Online - Litaratur", $TOPIC_KULTUR, 80, 1, 10000, "n");
	$zeit[19] = new Newsfeed("http://newsfeed.zeit.de/musik/index", "Die Zeit Online - Musik", $TOPIC_KULTUR, 80, 1, 10000, "n");
	$zeit[20] = new Newsfeed("http://newsfeed.zeit.de/leben/index", "Die Zeit Online - Leben", $TOPIC_BG, 80, 1, 10000, "n");
	$zeit[21] = new Newsfeed("http://newsfeed.zeit.de/sport/index", "Die Zeit Online - Sport", $TOPIC_BG, 80, 1, 10000, "n");
	$zeit[22] = new Newsfeed("http://newsfeed.zeit.de/reisen/index", "Die Zeit Online - Reisen", $TOPIC_AUSLAND, 80, 1, 10000, "n");
	$zeit[23] = new Newsfeed("http://newsfeed.zeit.de/auto/index", "Die Zeit Online - Auto", $TOPIC_BG, 80, 1, 10000, "n");
	
	$zeit["name"] = "zeit.de";
	$feedsByUrl["zeit"] = $zeit;

	
	/////
	// ZDF

	$zdf[0] = new Newsfeed("http://content.zdf.de/podcast/zdf_f21/f21toll_v.xml", "ZDF - Frontal 21", $TOPIC_BG, 80, 1, null, "n");
	
	$zdf["name"] = "ZDF.de";
	$feedsByUrl["zdf"] = $zdf;

	/////
	// Focus

	$focus[0] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews.xml", "Focus Online", $TOPIC_BG, 80, 1, null, "n");
	$focus[1] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_politik.xml", "Focus Online - Politik", $TOPIC_BG, 80, 1, null, "n");
	$focus[2] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_finanzen.xml", "Focus Online - Finanzen", $TOPIC_BG, 80, 1, null, "n");
	$focus[3] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_panorama.xml", "Focus Online - Panorama", $TOPIC_BG, 80, 1, null, "n");
	$focus[4] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_gesundheit.xml", "Focus Online - Gesundheit", $TOPIC_HEALTH, 80, 1, null, "n");
	$focus[5] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_sport.xml", "Focus Online - Sport", $TOPIC_BG, 80, 1, null, "n");
	$focus[6] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_auto.xml", "Focus Online - Auto", $TOPIC_BG, 80, 1, null, "n");
	$focus[7] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_digital.xml", "Focus Online - Digital", $TOPIC_BG, 80, 1, null, "n");
	$focus[8] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_reisen.xml", "Focus Online - Reisen", $TOPIC_BG, 80, 1, null, "n");
	$focus[9] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_kultur.xml", "Focus Online - Kultur", $TOPIC_BG, 80, 1, null, "n");
	$focus[10] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_wissen.xml", "Focus Online - Wissen", $TOPIC_BG, 80, 1, null, "n");
	$focus[11] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_jobs.xml", "Focus Online - Jobs", $TOPIC_BG, 80, 1, null, "n");
	$focus[12] = new Newsfeed("http://rss.focus.de/fol/XML/rss_folnews_immobilien.xml", "Focus Online - Immobilien", $TOPIC_BG, 80, 1, null, "n");

	$focus["name"] = "focus.de";
	$feedsByUrl["focus"] = $focus;

	
	/////
	// Heise News (siehe http://www.heise.de/news-extern/news.shtml)

	$heise[0] = createAtomFeed("http://www.heise.de/newsticker/heise-atom.xml", "Heise News", $TOPIC_TECH, 104, 3, null, "y", "n");
	$heise[1] = createAtomFeed("http://www.heise.de/security/news/news-atom.xml", "Heise News - Security", $TOPIC_TECH, 104, 3, null, "y", "n");
	$heise[2] = createAtomFeed("http://www.heise.de/mobil/newsticker/heise-atom.xml", "Heise News - Mobile", $TOPIC_TECH, 104, 3, null, "y", "n");
	$heise[3] = createAtomFeed("http://www.heise.de/open/news/news-atom.xml", "Heise News - Open Source", $TOPIC_TECH, 104, 3, null, "y", "n");
	$heise[4] = createAtomFeed("http://www.heise.de/netze/rss/news-atom.xml", "Heise News - Netze", $TOPIC_TECH, 104, 3, null, "y", "n");
	$heise[5] = createAtomFeed("http://www.heise.de/resale/rss/resale-atom.xml", "Heise News - Resale", $TOPIC_TECH, 104, 3, null, "y", "n");
	$heise[6] = createAtomFeed("http://www.heise.de/autos/rss/news-atom.xml", "Heise News - Autos", $TOPIC_AUTO, 104, 3, null, "y", "n");
	$heise[7] = createAtomFeed("http://www.heise.de/tp/news-atom.xml", "Heise News - Telepolis", $TOPIC_TECH, 80, 1, null, "y", "y");
	$heise[8] = createAtomFeed("http://www.heise.de/tr/news-atom.xml", "Heise News - Technology Review", $TOPIC_TECH, 104, 3, 10000, "y", "n");
	
	$heise[10] = createAtomFeed("http://www.heise.de/ix/news/news-atom.xml", "Heise IX", $TOPIC_TECH, 104, 3, null, "y", "n");
	$heise[11] = createAtomFeed("http://www.heise.de/ix/blog/1/blog-atom.xml", "Heise IX Blog - Dotnet Doktor", $TOPIC_TECH, 80, 1, null, "y", "y");
	$heise[12] = createAtomFeed("http://www.heise.de/ix/blog/2/blog-atom.xml", "Heise IX Blog - Bernds Management-Welt", $TOPIC_TECH, 80, 1, null, "y", "y");
	$heise[13] = createAtomFeed("http://www.heise.de/ix/blog/3/blog-atom.xml", "Heise IX Blog - The World of IT", $TOPIC_TECH, 80, 1, null, "y", "y");
	
	$heise["name"] = "heise.de";
	$feedsByUrl["heise"] = $heise;
	
	
	/////
	// N24

	$n24[0] = new Newsfeed("http://feeds.feedburner.com/n24/homepage?format=xml", "N24 - Nachrichten", $TOPIC_HEADLINES, 100, 1, null, "y");
	$n24[1] = new Newsfeed("http://feeds.feedburner.com/n24/news_stories?format=xml", "N24 - News & Stories", $TOPIC_HEADLINES, 100, 1, null, "y");
	$n24[2] = new Newsfeed("http://feeds.feedburner.com/n24/videos?format=xml", "N24 - Videos", $TOPIC_HEADLINES, 100, 1, null, "y");
	$n24[3] = new Newsfeed("http://feeds.feedburner.com/n24/bildergalerien?format=xml", "N24 - Bildergallerien", $TOPIC_HEADLINES, 100, 3, null, "y");
	$n24[3]->showSummary = "n";
	$n24[4] = new Newsfeed("http://feeds.feedburner.com/n24/politik?format=xml", "N24 - Politik", $TOPIC_BG, 100, 1, null, "y");
	$n24[5] = new Newsfeed("http://feeds.feedburner.com/n24/wirtschaft_boerse?format=xml", "N24 - Wirtschaft & Börse", $TOPIC_GELD, 100, 1, null, "y");
	$n24[6] = new Newsfeed("http://feeds.feedburner.com/n24/wissen_technik?format=xml", "N24 - Wissen & Technik", $TOPIC_TECH, 100, 1, null, "y");
	$n24[7] = new Newsfeed("http://feeds.feedburner.com/n24/sport?format=xml", "N24 - Sport", $TOPIC_SPORT, 100, 1, null, "y");
	$n24[8] = new Newsfeed("http://feeds.feedburner.com/n24/tv?format=xml", "N24 - TV-Programm", null, 120, 1, null, "y");	

	$n24["name"] = "n24.ch";
	$feedsByUrl["n24"] = $n24;


	/////
	// Presseportal.ch

	$press[1] = new Newsfeed("http://www.presseportal.ch/de/rss/presseportal.rss", "Presseportal", $TOPIC_HEADLINES, 100, 1, null, "n");
	$press[2] = new Newsfeed("http://www.presseportal.ch/de/rss/wirtschaft.rss", "Presseportal - Wirtschaft", $TOPIC_GELD, 100, 1, null, "n");
	$press[3] = new Newsfeed("http://www.presseportal.ch/de/rss/inland.rss", "Presseportal - Inland", $TOPIC_SCHWEIZ, 100, 1, null, "n");
	$press[4] = new Newsfeed("http://www.presseportal.ch/de/rss/ausland.rss", "Presseportal - Ausland", $TOPIC_AUSLAND, 100, 1, null, "n");
	$press[5] = new Newsfeed("http://www.presseportal.ch/de/rss/vermischtes.rss", "Presseportal - Vermischtes", $TOPIC_KLATSCH, 100, 1, null, "n");
	$press[6] = new Newsfeed("http://www.presseportal.ch/de/rss/kultur.rss", "Presseportal - Kultur", $TOPIC_KULTUR, 100, 1, null, "n");
	$press[7] = new Newsfeed("http://www.presseportal.ch/de/rss/sport.rss", "Presseportal - Sport", $TOPIC_SPORT, 100, 1, null, "n");

	$press[10] = new Newsfeed("http://www.presseportal.ch/de/rss/bau.rss", "Presseportal - Bau", null, 100, 1, null, "n");
	$press[11] = new Newsfeed("http://www.presseportal.ch/de/rss/chemie.rss", "Presseportal - Chemie/Pharma", null, 100, 1, null, "n");
	$press[12] = new Newsfeed("http://www.presseportal.ch/de/rss/energie.rss", "Presseportal - Energie", null, 100, 1, null, "n");
	$press[13] = new Newsfeed("http://www.presseportal.ch/de/rss/gesundheit.rss", "Presseportal - Gesundheit/Medizin", $TOPIC_HEALTH, 100, 1, null, "n");
	$press[14] = new Newsfeed("http://www.presseportal.ch/de/rss/computer.rss", "Presseportal - IT/Computer", $TOPIC_TECH, 100, 1, null, "n");
	$press[15] = new Newsfeed("http://www.presseportal.ch/de/rss/lebensmittel.rss", "Presseportal - Lebensmittel", null, 100, 1, null, "n");
	$press[16] = new Newsfeed("http://www.presseportal.ch/de/rss/medien.rss", "Presseportal - Medien", null, 100, 1, null, "n");
	$press[17] = new Newsfeed("http://www.presseportal.ch/de/rss/soziales.rss", "Presseportal - Soziales", null, 100, 1, null, "n");
	$press[18] = new Newsfeed("http://www.presseportal.ch/de/rss/telekommunikation.rss", "Presseportal - Telekommunikation", $TOPIC_TECH, 100, 1, null, "n");
	$press[19] = new Newsfeed("http://www.presseportal.ch/de/rss/tourismus.rss", "Presseportal - Tourismus/Gastronomie", null, 100, 1, null, "n");
	$press[20] = new Newsfeed("http://www.presseportal.ch/de/rss/umwelt.rss", "Presseportal - Umwelt/Tiere", null, 100, 1, null, "n");
	$press[21] = new Newsfeed("http://www.presseportal.ch/de/rss/verkehr.rss", "Presseportal - Verkehr/Transport", null, 100, 1, null, "n");
	
	$press[30] = new Newsfeed("http://www.presseportal.ch/de/rss/10280,10021.rss", "Presseportal - Aktuelle Fotos & Grafiken ", null, 100, 1, null, "n");

	$press["name"] = "presseportal.ch";
	$feedsByUrl["press"] = $press;


/*
	/////
	// Finanzen.net

	$finanzen[0] = new Newsfeed("http://www.finanzen.net/rss/rss_news.asp", "finanzen.net - News", $TOPIC_GELD, 72, 1, 10000);
	$finanzen[1] = new Newsfeed("http://www.finanzen.net/rss/rss_analysen.asp", "finanzen.net - Analysen", $TOPIC_GELD, 72, 1, 10000);
	$finanzen["name"] = "finanzen.net";
	$feedsByUrl["finanzen"] = $finanzen;

	/////
	// Finanznachrichten.de

	$finanznach[0] = new Newsfeed("http://www.finanznachrichten.de/service/nachrichten.xml", "finanznachrichten.de - Nachrichten", $TOPIC_GELD, 104, 1, 10000);
	$finanznach[1] = new Newsfeed("http://www.finanznachrichten.de/service/analysen.xml", "finanznachrichten.de - Aktienanalysen", $TOPIC_GELD, 104, 1, 10000);
	$finanznach[2] = new Newsfeed("http://www.finanznachrichten.de/service/adhoc.xml", "finanznachrichten.de - Ad-hoc Mitteilungen", $TOPIC_GELD, 104, 1, 10000);
	$finanznach["name"] = "finanznachrichten.de";
	$feedsByUrl["finanznachrichten"] = $finanznach;


	/////
	// manager-magazin.de

	$manager[0] = new Newsfeed("http://www.manager-magazin.de/news/rss/0,5796,,00.xml", "manager-magazin.de - News", $TOPIC_GELD, 64, 1, 10000);
	$manager[1] = new Newsfeed("http://www.manager-magazin.de/news/rss/0,5796,c-220,00.xml", "manager-magazin.de - Unternehmen & Politik", $TOPIC_GELD, 64, 3, 10000);
	$manager[2] = new Newsfeed("http://www.manager-magazin.de/news/rss/0,5796,c-221,00.xml", "manager-magazin.de - Geld & Börse", $TOPIC_GELD, 64, 3, 10000);
	$manager[3] = new Newsfeed("http://www.manager-magazin.de/news/rss/0,5796,c-226,00.xml", "manager-magazin.de - Köpfe & Karriere", $TOPIC_GELD, 64, 3, 10000);
	$manager["name"] = "manager-magazin.de";
	$feedsByUrl["manager"] = $manager;
*/


	/////
	// Symlink.ch

	$symlink[0] = new Newsfeed("http://www.symlink.ch/symlinkch.rss", "symlink.ch", $TOPIC_TECH, 160, 1, 16000, "y");
	$symlink["name"] = "symlink.ch";
	$feedsByUrl["symlink"] = $symlink;


	/////
	// Dr.Web

	$drweb[0] = new Newsfeed("http://www.drweb.de/weblog/weblog/wp-rss2.php", "Dr. Web", $TOPIC_TECH, 120, 1, 10000, "y");
	$drweb["name"] = "drweb.de";
	$feedsByUrl["drweb"] = $drweb;

	
	/////
	// The New York Times

	$nytimes[0] = new Newsfeed("http://www.nytimes.com/services/xml/rss/nyt/HomePage.xml", "New York Times - Front Page", $TOPIC_HEADLINES, 80, 1, null, "y");
	$nytimes[1] = new Newsfeed("http://www.nytimes.com/services/xml/rss/nyt/Europe.xml", "New York Times - Europe News", $TOPIC_AUSLAND, 100, 1, null, "y");
	$nytimes[2] = new Newsfeed("http://www.nytimes.com/services/xml/rss/nyt/MiddleEast.xml", "New York Times - Middle East News", $TOPIC_AUSLAND, 80, 1, null, "y");
	
	$nytimes[3] = new Newsfeed("http://www.nytimes.com/services/xml/rss/nyt/Nutrition.xml", "New York Times - Fitness and Nutrition", $TOPIC_HEALTH, 80, 1, null, "y");
	$nytimes[4] = new Newsfeed("http://www.nytimes.com/services/xml/rss/nyt/Psychology.xml", "New York Times - Mental Health & Behavior", $TOPIC_HEALTH, 80, 1, null, "y");
	
	$nytimes[5] = new Newsfeed("http://www.nytimes.com/services/xml/rss/nyt/Movies.xml", "New York Times - Movie Reviews", $TOPIC_HEALTH, 80, 1, null, "y");

	$nytimes["name"] = "nytimes.com (english)";
	$feedsByUrl["nytimes"] = $nytimes;
	
	
	/////
	// news.com

	$newscom[0] = new Newsfeed("http://news.com.com/2547-1_3-0-20.xml", "news.com", $TOPIC_HEADLINES, 80, 1, 16000, "y");
	$newscom["name"] = "news.com (english)";
	$feedsByUrl["newscom"] = $newscom;

	/////
	// Slashdot.org

	$slashdot[0] = new Newsfeed("http://rss.slashdot.org/Slashdot/slashdot", "slashdot.org", $TOPIC_TECH, 200, 1, 10000, "y");
	$slashdot["name"] = "slashdot.org (english)";
	$feedsByUrl["slashdot"] = $slashdot;

	/////
	// RSR - Radio Suisse Romande (http://www1.rsr.ch/rsr/podcasting/index.aspx)
	$rsr[0] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=tas-entendu", "RSR Espace 1 - T'as entendu?", null, 164, 1, null, "y");
	
	$rsr[30] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=son-du-jour", "RSR Couleur 3 - Le son du hour", null, 70, 1, null, "y");
	$rsr[30]->showSummary = "n";
	$rsr[31] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=lutte-des-classes", "RSR Couleur 3 - La lutte des classes", null, 70, 1, null, "y");
	$rsr[31]->showSummary = "n";
	$rsr[32] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=c3-microsillon", "RSR Couleur 3 - Le microsillon du jour", null, 70, 1, null, "y");
	$rsr[32]->showSummary = "n";
	$rsr[33] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=point-barre", "RSR Couleur 3 - Pointbarre", null, 70, 1, null, "y");
	$rsr[33]->showSummary = "n";
	$rsr[34] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=c3blog", "RSR Couleur 3 - La revue de blog", null, 70, 1, null, "y");
	$rsr[34]->showSummary = "n";
	$rsr[35] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=zimages", "RSR Couleur 3 - Z'Images", null, 70, 1, null, "y");
	$rsr[35]->showSummary = "n";
	$rsr[36] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=bamako", "RSR Couleur 3 - Genève - Bamako", null, 70, 1, null, "y");
	$rsr[36]->showSummary = "n";
	$rsr[37] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=3615", "RSR Couleur 3 - 3615", null, 70, 1, null, "y");
	$rsr[37]->showSummary = "n";
	
	$rsr["name"] = "rsr.ch (français)";
	$feedsByUrl["rsr"] = $rsr;
	
	
	/////
	// Diverse

	$diverse[0] = new Newsfeed("http://feeds.feedburner.com/tapestrydilbert", "Dilbert", $TOPIC_COMICS, 0, 1, 25000, "y");
	$diverse[0]->htmlentities = false;
	//$diverse[1] = new Newsfeed("http://www.nichtlustig.de/rss/nichtrss.rss", "Nicht Lustig", $TOPIC_COMICS, 0, 1, 20000, "y");
	//$diverse[1]->htmlentities = false;
	$diverse[2] = new Newsfeed("http://feeds.feedburner.com/tapestrydrabble", "Drabble", $TOPIC_COMICS, 0, 1, 20000, "y");
	$diverse[2]->htmlentities = false;
	$diverse[3] = new Newsfeed("http://feeds.feedburner.com/tapestrybc", "B.C.", $TOPIC_COMICS, 0, 1, 20000, "y");
	$diverse[3]->htmlentities = false;
	$diverse[4] = new Newsfeed("http://www.comic.de/neues.xml", "comics.de - Berichte und Neuigkeiten", $TOPIC_COMICS, 0, 1, null, "y");
	$diverse[6] = new Newsfeed("http://rss.api.ebay.com/ws/rssapi?FeedName=SearchResults&siteId=77&language=de-DE&output=RSS20&catref=C6&fsop=1&sacat=3957&fsoo=1&satitle=International&from=R4", "Ebay International - Kategorie Comic", $TOPIC_COMICS, 0, 1, null, "y");
	
	//$diverse[10] = new Newsfeed("http://www.rsr.ch/podcast.aspx?rss=son-du-jour", "Couleur 3 - Son du jour", null, 64, 1, null, "y");
	$diverse[10] = new Newsfeed("http://feeds.feedburner.com/podcastfrancaisfacile", "Podcast français facile - Französisch lernen", null, 64, 1, null, "y");
	
	$diverse["name"] = "(Diverse)";
	$feedsByUrl["zz_diverse"] = $diverse;

	
	return $feedsByUrl;

}

/**
 * Traverses all feeds of each page and sorts them according to the feed->topic
 * into arrays which are associated by the topic string in the array $feedsByTopic.
 */
function initFeedsByTopics($feedsByUrl) {

	global $topics, $topicNames;

	// add names for convenience and specify list order
	foreach ($topics as $topic) {
		$feedsByTopic[$topic]["name"] = $topicNames[$topic];
	}	
	
	foreach($feedsByUrl as $key => $foo) {
		foreach($feedsByUrl[$key] as $feed) {
			foreach ($topics as $topic) {
				if ($feed->topic == $topic) {
					$feedsByTopic[$topic][] = $feed;
				}
			}
		}
	}

	return $feedsByTopic;
}

function initPodcasts($feedsByUrl) {

	$podcasts[0] = array(
		$feedsByUrl["a4_drs"][1],
		$feedsByUrl["a4_drs"][2],
		$feedsByUrl["a4_drs"][3],
		$feedsByUrl["a4_drs"][4],
		$feedsByUrl["a4_drs"][5],
		$feedsByUrl["a4_drs"][6],
		$feedsByUrl["a4_drs"][7],
		
		$feedsByUrl["a4_drs"][11],
		$feedsByUrl["a4_drs"][12],
		$feedsByUrl["a4_drs"][13],
		$feedsByUrl["a4_drs"][14],
		$feedsByUrl["a4_drs"][15],
		$feedsByUrl["a4_drs"][16],
		
		$feedsByUrl["a4_drs"][21],
		$feedsByUrl["a4_drs"][22],
		$feedsByUrl["a4_drs"][23],
		$feedsByUrl["a4_drs"][24],
		$feedsByUrl["a4_drs"][25],
		$feedsByUrl["a4_drs"][26],
		$feedsByUrl["a4_drs"][27],
		
		$feedsByUrl["a4_drs"][31],
		$feedsByUrl["a4_drs"][32],
		$feedsByUrl["a4_drs"][33],
		$feedsByUrl["a4_drs"][34],
		$feedsByUrl["a4_drs"][35],
		
		$feedsByUrl["n24"][2],
		$feedsByUrl["zeit"][2],
		$feedsByUrl["weltwoche"][1],
		
		$feedsByUrl["rsr"][0],
		$feedsByUrl["rsr"][30],
		$feedsByUrl["rsr"][31],
		$feedsByUrl["rsr"][32],
		$feedsByUrl["rsr"][33],
		$feedsByUrl["rsr"][34],
		$feedsByUrl["rsr"][35],
		$feedsByUrl["rsr"][36],
		$feedsByUrl["rsr"][37],
		
		$feedsByUrl["zz_diverse"][10],
		
	);

	return $podcasts;
}

function initSwissNews($feedsByUrl) {

	$snews["nzz"] = $feedsByUrl["a1_nzz"];
	$snews["nzz"]["name"] = "NZZ";
	$snews["tagi"] = $feedsByUrl["a2_tagi"];
	$snews["tagi"]["name"] = "Tagesanzeiger";
	$snews["blick"] = $feedsByUrl["a3_blick"];
	$snews["blick"]["name"] = "Blick";
	$snews["weltwoche"] = $feedsByUrl["weltwoche"];
	$snews["weltwoche"]["name"] = "Die Weltwoche";

	return $snews;
}

$feeds["byUrl"] = initFeedsByUrl(); 
// ksort($feeds["byUrl"]);
$feeds["byTopic"] = initFeedsByTopics($feeds["byUrl"]);
$feeds["podcasts"] = initPodcasts($feeds["byUrl"]);
$feeds["swissnews"] = initSwissNews($feeds["byUrl"]);

?>