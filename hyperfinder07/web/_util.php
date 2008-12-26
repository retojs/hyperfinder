<?php

/////
// Text constants

$TXT["FIND"] = "Finden";

// labels

$labels["Basic"] = "BASIC";
$labels["Nav"] = "NAVIGATION";
$labels["Wetter"] = "WETTER";
$labels["Handel"] = "HANDEL";
$labels["Fun"] = "UNTERHALTUNG";

$labels["commandline"] = "Kommandozeile";
$labels["google"] = "Google";
$labels["leo"] = "Diktion&auml;re";
$labels["wiki"] = "Wikipedia";
$labels["news"] = "News&nbsp;&&nbsp;Podcasts";
$labels["mylinks"] = "Ausgew&auml;hlte Links";

$labels["sbb"] = "SBB Fahrplan";
$labels["route"] = "Routenplaner";
$labels["mapsearch"] = "Schweizerkarte";
$labels["telsearch"] = "Telefonbuch";
$labels["gelbe"] = "Gelbe&nbsp;Seiten";

$labels["meteo"] = "Wetter";
$labels["webcams"] = "Webcams";
$labels["snow"] = "Schneebericht";

$labels["tv"] = "TV-Programm";
$labels["cineman"] = "Kinoprogramm";
$labels["ytube"] = "YouTube";
$labels["imdb"] = "Filmdatenbank";

$labels["ricardo"] = "Ricardo";
$labels["ebay"] = "Ebay";
$labels["amazon"] = "Amazon";
$labels["swissquote"] = "B&ouml;rsenkurse";
$labels["fx"] = "Wechselkurse";
$labels["preisvgl"] = "Preisvergleich";

/////
// groups of slots 

$slots["Basic"] = array (   
	"commandline",    
	"google",
	"leo",
	"wiki",
	"news", 
	"mylinks"
);
$slots["Nav"] = array (
	"sbb",
	"route",
	"mapsearch",
	"telsearch",
	"gelbe"
);
$slots["Wetter"] = array (
	"meteo",
	"webcams",
	"snow"
);
$slots["Fun"] = array (
	"tv",
	"cineman",
	"ytube",
	"imdb"
);
$slots["Handel"] = array (
	"ricardo",
	"ebay",
	"amazon",
	"swissquote",
	"fx",
	"preisvgl"
);
	
$tabindex = array(
	"google" => "1",
	"leo0" => "2",
	"leo1" => "3",
	"leo2" => "4",
	"leo3" => "5",
	"wiki" => "6", 
	"sbb0" => "7", 
	"sbb1" => "8", 
	"sbb2" => "9", 
	"sbb3" => "10"
);

function getLogo() {
	if (isset ($_COOKIE['logo'])) {
		return $_COOKIE['logo'];
	} else {
		return 'hyperfinder.gif';
	}
}

function getLogoDesc() {
	$logo_desc['hyperfinder.gif'] = 'Dom, Saas Fee';
	$logo_desc['hyperfinder2.gif'] = 'Appenzell';
	$logo_desc['hyperfinder3.gif'] = 'Dent de Jaman, Vaadt';
	$logo_desc['hyperfinder4.gif'] = 'Jaman, Vaadt';
	$logo_desc['hyperfinder5.gif'] = 'Pr&auml;ttigau';

	$logo = 'hyperfinder.gif';
	if (isset ($_COOKIE['logo'])) {
		$logo = $_COOKIE['logo'];
	}
	return $logo_desc[$logo];
}

function printRubrikHeader($slotkey, $labels) {
	?>
	<tr>
		<td colspan="5" align="center" style="padding:0px">
			<a name="<?php echo $slotkey; ?>_anchorShow" ></a>
			<?php printJumpMenu($slotkey); ?>	
		</td>
	</tr>
	<tr>		
		<td colspan="5" class="rubriken">
			<?php echo $labels[$slotkey] ?>:
		</td>
	</tr>
	<?php
}

function printSpacer($height) {
	?>
	<tr class="spacer">
		<td colspan="5" >&nbsp;</td>
	</tr>
	<?php
}

function printBottomSpacer($height) {
	?>
	<tr>
		<td colspan="5" class="bottomSpacer pagebg">&nbsp;</td>
	</tr>
	<?php
}

function printSlots($slots, $labels) {
	global $TXT, $tabindex;
	foreach ($slots as $slotkey => $slotarray) {
		printRubrikHeader($slotkey, $labels);
		foreach ($slotarray as $slot) {
			printSpacer(2);
			require_once ("slots/slot_" . $slot . ".php");
		}
		printBottomSpacer(30);
	}
}

function printJumpMenu($current_slotkey) {
	global $slots, $labels;
	print "<div class=\"jump_menu\">";
	$i = 0;
	foreach ($slots as $slotkey => $slotarray) {
		$i++;
		if ($slotkey == $current_slotkey) {
			print $labels[$slotkey];
		} else {
			print "<a href=\"#". $slotkey ."_anchorShow\">&nbsp;$labels[$slotkey]&nbsp;</a>";
		}
		if ($i < sizeof($slots)) {
			print "&nbsp;&nbsp;";
		}
	}
	print "</div>";
}

$topTitle = array();
$topTitle["main"] = "Die ideale Startseite...";
$topTitle["share"] = "Die ideale Startseite für Freunde...";
$topTitle["feedback"] = "Die ideale Startseite, die zuhört...";

/** Mode = "main" | "share" | "feedback" */
function printLogoHeader($mode) {
	global $topTitle;
	?>
	<div id="headline">
		<span id="headline1"><?php print $topTitle[$mode] ?></span>
		<span id="headline2">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&gt;&nbsp;<a target="_blank" href="http://www.youtube.com/watch?v=L3JTpxaKSsM&fmt=6">YouTube&nbsp;-&nbsp;Tutorials</a></span>
		<span id="logo_desc">
			<?php if ($mode === "main") { ?>
			Aussicht: <?php echo getLogoDesc() ?>
			<a href="javascript:toggleLogo()"><strong>wechseln</strong></a>
			<?php } ?>
		</span>
	</div>
	<div id="logo" style="background-image:url('img/<?php echo getLogo(); ?>')" onClick="makeHomepage()">&nbsp;</div>
	<div id="menu_top">
		<a id="make_homepage" href="javascript:makeHomepage()">hyperfinder.ch zu meiner Startseite machen</a>
		<?php if ($mode === "main") { ?>
		<a class="feedback_share" href="feedback.php">Feedback</a>
		<a class="feedback_share" href="share.php">Freunde einladen</a>
		<?php } else if ($mode === "share") { ?>
		<a class="feedback_share" href="feedback.php">Feedback</a>
		<a class="feedback_share" href="index.php">Hauptseite</a>
		<?php } else if ($mode === "feedback") { ?>
		<a class="feedback_share" href="index.php">Hauptseite</a>
		<a class="feedback_share" href="share.php">Freunde einladen</a>
		<?php } ?>
	</div>
	<?php
}

function printHTMLHeader($fade) {
	$refresh = false;
	?>
		<head>
		<title>
			hyperfinder.ch - leichter finden...
		</title>
		<?php if ($refresh) { ?>
		<meta http-equiv="expires" content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma" content="no-cache">
		<?php } ?>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<?php if ($fade) { ?>
		<meta http-equiv="page-enter" content="blendTrans(Duration=0.3)" />
		<meta http-equiv="page-exit" content="blendTrans(Duration=0.3)" />
		<?php } ?>
		<meta name="keywords" 
		content="hyperfinder, suche, suchen, finden, information, google, internet, 
leo, dict.leo.org, diktionär, online dix, übersetzen, übersetzung, übersetzungen, 
wikipedia, lexikon, enzyklopädie,  
tel.search.ch, map.search.ch, adresse, adressen, telefonnummer, 
viamichelin, map24, maporama, route, routenplan, routenplaner, routenplanung,
amazon, amazon.ch, shop, onlineshop, bestellen, kaufen, medien, bücher, cd, video, dvd,  
ricardo, ricardo.ch, ebay.ch, ebay, versteigerung, versteigerungen, occasion, occasionen,
imdb.com, imdb, film, filme, kino, movie, movie database,
kinoprogramm, cineman, cineman.ch,
börse, börsenkurs, börsenkurse, smi, swissquote, swissquote.ch">

		<link rel="shortcut icon" href="favicon.ico" type="image/ico" />
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<link rel="stylesheet" type="text/css" href="css/bg.css">
		<link rel="search" type="application/opensearchdescription+xml" title="Hyperfinder" href="http://hyperfinder.ch/OpenSearch/Hyperfinder.xml">
		<script type="text/javascript" src="gzip.php?file=js.js"></script>
		<script type="text/javascript" src="gzip.php?file=news.js"></script>
	</head>
	<?php
}
?>