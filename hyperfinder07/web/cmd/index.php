<?php include "user/_user_cookies.php" ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Hyperfinder Kommandozeile</title>
<link rel="shortcut icon" href="http://hyperfinder.ch/favicon.ico" type="image/ico" />
<meta name="keywords" content="hyperfinder, suche, suchen, finden, information, google, internet, 
leo, dict.leo.org, diktionär, online dix, übersetzen, übersetzung, übersetzungen, 
wikipedia, lexikon, enzyklopädie,  
tel.search.ch, map.search.ch, adresse, adressen, telefonnummer, 
viamichelin, map24, maporama, route, routenplan, routenplaner, routenplanung,
amazon, amazon.ch, shop, onlineshop, bestellen, kaufen, medien, bücher, cd, video, dvd,  
ricardo, ricardo.ch, ebay.ch, ebay, versteigerung, versteigerungen, occasion, occasionen,
imdb.com, imdb, film, filme, kino, movie, movie database,
kinoprogramm, cineman, cineman.ch,
börse, börsenkurs, börsenkurse, smi, swissquote, swissquote.ch">

<link rel="stylesheet" type="text/css" href="http://hyperfinder.ch/css/cmd.css" />
<link rel="search" type="application/opensearchdescription+xml" title="Hyperfinder" href="http://hyperfinder.ch/OpenSearch/Hyperfinder.xml">
<script type="text/Javascript">
function makeHomepage() {
	var homepage_url = <?php if ($pda == "y") {print "'http://pda.hyperfinder.ch'\n";} else {print "'http://cmd.hyperfinder.ch'\n";} ?>
	var browser = navigator.appName;
	var version = navigator.appVersion.substring(0,1);
	if ((browser=='Netscape') && (version >= 4 && version < 5)) {
		window.onerror=java_error;
		netscape.security.PrivilegeManager.enablePrivilege('UniversalPreferencesWrite');
		navigator.preference('signed.applets.codebase_principal_support', true);
		navigator.preference('browser.startup.homepage', homepage_url);
		alert('Voilà! '+ homepage_url + ' ist nun Ihre Startseite.');
	} else if ((browser=='Microsoft Internet Explorer') && (version >= 4)) {
		// MSIE 4.x, 5.x Version
		document.body.style.behavior='url(#default#homepage)';
		document.body.setHomePage(homepage_url);
	} else {
		// Manuelle Einstellung nötig
		alert('Wenn sie <?php if ($pda == "y") {print "pda.hyperfinder.ch";} else {print "cmd.hyperfinder.ch";} ?> (Kommandozeile) zu ihrer Startseite machen möchten, gehen sie ins Menu Extras -> Einstellungen -> Startseite.');
	}
}
</script>
</head>
<body onload="document.f.find.focus()">
<center><br/>
<h2>Hyperfinder<br/>Kommandozeile</h2>
<form name="f" method="post" action="do.php">
<div id="commandline"><input tabindex=0 " type="text" name="find" id="find" <?php if ($pda != "y") print "style=\"width:360px\"";?> /></div>
<div id="commandlinemenu">
	<input type="hidden" name="pda" value="<?php print $pda;?>" /> 
	<input type="submit" value="Finden" /><br />
	<br/>
	<a href="?page=help">Wie funktioniert's?</a>&nbsp;-&nbsp; 
	<a href="javascript:makeHomepage()">Als Startseite</a>&nbsp;-&nbsp; 
	<a href="?page=user">Meine Kommandos</a>&nbsp;-&nbsp; 
	<a href="http://hyperfinder.ch" title="Mit separaten Eingabefeldern für alle Standard-Kommandos">Hyperfinder.ch</a> 
	<br/>
	<br/>
</div>
</form>
</center>
<!-- <div style="float: right"><iframe src="http://hyperfinder.ch/counter.htm" name="counterframe" height="20" scrolling="no" frameborder="0"></iframe></div> -->

<?php if (isset($_GET['page'])) {include("frontController.php");} ?>

<?php print "<!-- userid = ". $userid_ . ", userpwd = $userpwd_ -->\n"; ?>
<?php print "<!-- _COOKIE[hyperid] = " . $_COOKIE["hyperid"] . ", COOKIE[hyperpwd] = " . $_COOKIE["hyperpwd"] . " -->\n"; ?>

<?php include ("../analyticsTracking.php"); ?>
</body>
</html>
