<?php

header("Content-Type: text/html; charset=ISO-8859-1"); 

require_once "navigation.php";

function googlenewsUmlautEncode($str) {
	$out = str_replace ("ä", "ae", $str );
	$out = str_replace ("ö", "oe", $out );
	$out = str_replace ("ü", "ue", $out );
	$out = str_replace (" ", "%20", $out );
	return $out;
}

$stichwort = googlenewsUmlautEncode($_REQUEST["stichwort"]);

// parse the RSS document:
if ($stichwort && "" != trim($stichwort)) {
	require("parserRSS.php");
	parseRSS("http://www.google.ch/news?hl=de&q=".$stichwort."&on=&ie=UTF-8&output=rss", "y");
} else {
	return;
}

if (sizeof($ITEMS) == 0) {
	print "Sorry, keine News zu diesem Thema gefunden.";
	die();
}

foreach ($ITEMS as $i => $item) {

	$desc = $item["description"];

	?>
	<div id="<?php print $i; ?>" style="<?php if($i != 0) print "display:none"?>" onmouseover="stopTicker()" onmouseout="startTicker()">
		<?php printNavigation($ITEMS, $i); ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td>
					<img src="leer" height="225" width="1" />
				</td>
				<td valign="top">
					<div class="google news"><?php print trim($desc);?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<?php
}
?>
