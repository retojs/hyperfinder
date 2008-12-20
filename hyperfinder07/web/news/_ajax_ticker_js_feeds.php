<?php

header("Content-Type: text/html; charset=iSO-8859-1"); 
//header("Content-Type: text/html; charset=UTF-8"); 

require_once "feedList.php";
require_once "navigation.php";

// replace <BR>-tag with white space
function strip_br_tag($str) {
	$str = str_replace ("-<BR>", "", $str);
	$str = str_replace ("-<br>", "", $str);
	$str = str_replace ("<BR>", " ", $str);
	$str = str_replace ("<br>", " ", $str);
	
	$str = str_replace ("-<BR/>", "", $str);
	$str = str_replace ("-<br/>", "", $str);
	$str = str_replace ("<BR/>", " ", $str);
	$str = str_replace ("<br/>", " ", $str);
	
	return $str;
}

// replace &amp; with &...
function recode($str) {
	$str = str_replace ("&amp;", "&", $str);
	return $str;	
}

// Parses a date of the format yyyy-mm-dd.hh:mm...
function parseISO8601Date($string) {
	$y = substr($string, 0, 4);
	$mo = substr($string, 5, 2);
	$d = substr($string, 8, 2);
	$h = substr($string, 11, 2);
	$mi = substr($string, 14, 2);
	return mktime($h, $mi, 0, $mo, $d, $y);
}

function getFeedHash($feed, $item) {
	if ($feed->atom) {
		$timeStmp = parseISO8601Date($item["updated"]);
	} else {
		$timeStmp_ = strtotime($item["pubDate"], time());
		// adjust timezone (necessary for NZZ...)
		$timeStmp = strtotime("-1 hours", $timeStmp_);
	}
	$date =  date("y-m-d-H-i", $timeStmp);
	$hash = strtr(strtr(substr(urlencode($item["title"]), 0, 12), "%", "-"), "+", "-");
	return $date ."-". $hash;
}

// berechnet den Zeitunterschied
function getTimeDiff($date, $now) {

	// analog zur schriftlichen subtraktion
	if ($date["minutes"] > $now["minutes"]) {
		$diffMinutes = 60 - $date["minutes"] + $now["minutes"];
		$date["hours"] += 1;
	} else {
		$diffMinutes = $now["minutes"] - $date["minutes"];
	}
	if ($date["hours"] > $now["hours"]) {
		$diffHour = 24 - $date["hours"] + $now["hours"];
		$date["yday"] += 1;
	} else {
		$diffHour = $now["hours"] - $date["hours"];
	}
	if ($now["yday"] > $date["yday"]) {
		$diffDay = $now["yday"] - $date["yday"];
	}

	$timeDiffString = "";
	if ($diffDay != null) {
		$timeDiffString .= $diffDay;
		if ($diffDay == 1) {
			$timeDiffString .= " Tag, ";
		} else {
			$timeDiffString .= " Tagen, ";
		}
	}
	if ($diffHour != null) {
		$timeDiffString .= $diffHour . " Std, ";
	}
	if ($diffMinutes != null) {
		$timeDiffString .= $diffMinutes . " Min";
	}
	
	return $timeDiffString;
}

// Schreibt den Schlagzeilentitel sowohl für ATOM als auch für RSS Newsfeeds.
function printTitle() {
	global $j, $feed, $title, $link, $mp3, $timeDiffString, $timeStmp;

	if(!isset($link) && isset($mp3) && "" != $mp3) {
		$link = $mp3;
	}

	if (isset($title) && trim($title) != "") {

		$title = recode(htmlentities(strip_br_tag($title)));
		if ($feed->showSummary != "y") {
			$title = "[".$j."] ".$title;
		}

		print "<span class=\"newsTitle\">";
		if (isset($link) && trim($link) != "") {
			print "<a href=\"$link\" target=\"rssnews\" onclick=\"suspendTicker()\">".trim($title)."</a>";
		} else {
			print trim($title);
		}
		print "</span>";
		
		print "<span class=\"newsDate\">";
		if ("" != $timeDiffString) {
			print "&nbsp;&nbsp;-&nbsp;gefunden vor $timeDiffString";
		}
		if (isset($timeStmp) && "" != $timeStmp) {
			print " (".date("d.m.Y H:i", $timeStmp).")";
		}
	} else {
		print "&nbsp;";
	}
	print "</span><br>";
}

$mode = $_REQUEST["mode"];
$select1 = $_REQUEST["select1"];
$select2 = $_REQUEST["select2"];
$feed = $feeds[$mode][$select1][$select2];

// parse the RSS document:
if ($feed->atom) {
	require_once "parserAtom.php";
	parseAtom($feed->url);
	$newsItems = $ENTRIES;

} else {
	require_once "parserRSS.php";
	parseRSS($feed->url, $feed->utf8);
	$newsItems = $ITEMS;
}

if (sizeof($newsItems) == 0) {
	print "Sorry, keine News zu diesem Thema gefunden.";
	die();
}

foreach ($newsItems as $i => $item) {
	// beim folgenden DIV wird class missbraucht, um das Datum des feeds hineinzuschreiben. Wird für shareNews gebraucht...
	?>
		<div id="<?php print $i; ?>" class="<?php print getFeedHash($feed, $item) ?>" style="<?php if($i != 0) print "display:none"?>" onmouseover="stopTicker()" onmouseout="startTicker(null, tickerTempo)">
			<?php printNavigation($newsItems, $i); ?>
			<table cellpadding="0" cellspacing="0" class="newsTable">
				<tr>
					<td>
						<?php
							if (isset($feed->height) && $feed->height > 0) {
								print "<img src=\"img/leer.gif\" height=\"$feed->height\" width=\"1\" />\n";
							}
						?>
					</td>
					<td style="vertical-align:top">
						
						<?php if ($feed->googleNews == "y") { ?>
						<div class="google news">
						<?php } else { ?>
						<div class="news">
						<?php } ?>
						
							<?php
							$nofitems_ = $feed->nofitems;
							if (!isset($nofitems_)) {
								$nofitems_ = 1;
							}
							
							for ($j = $i; $j < ($i + $nofitems_); $j++) {
								$timeStmp = null;	
								$timeDiffString = null;
							
								$item = $newsItems[$j];
								if ($feed->atom) {
									$title = $item["title"];
									$link = $item["id"];
									$summary = $item["summary"];
									$updated = $item["updated"];
									if (isset($updated) && "" != trim($updated)) {
										$timeStmp = parseISO8601Date($updated);
									}
								} else {
									$title = $item["title"];
									$link = $item["link"];
									$summary = $item["description"];
									$updated = $item["pubDate"];
									$author = $item["itunesAuthor"];
									if (isset($updated) && "" != trim($updated)) {
										$timeStmp_ = strtotime($updated, time());
										// adjust timezone (necessary for NZZ...)
										$timeStmp = strtotime("-1 hours", $timeStmp_);
									}
								}

								if (isset($updated) && "" != trim($updated)) {
									$date = getdate($timeStmp);
									$now = getdate(time());
									$timeDiffString = getTimeDiff($date, $now);
								}

								if (!$feed->googleNews) {
									printTitle();
								}
								
								if ($feed->showSummary != "n") {
									if (isset($summary) && $summary != "") {
										if ($feed->htmlentities) {
											$summary = recode(htmlentities(strip_tags($summary)));
										}
										print $summary;
										if ("" != $author && !strpos($summary, $author) > 0) {
											print "<div style=\"float:right\"><i>".$author."</i></div>";
										}
										print "<br>";
									}
								}
								
								// display podcast play / stop / open
								$mp3 = null;
								if($item["enclosure_type"] == "audio/mpeg") {
									$mp3 = $feed->enclosureURLPrefix . $item["enclosure_url"];
								}
								if(isset($mp3) && "" != $mp3) {
									?>
									<div class="mp3Link" onmouseover="suspendTicker()">
										<object align="middle" style="vertical-align:middle" width="200" height="20" type="application/x-shockwave-flash" data="http://web.sfc.keio.ac.jp/%7Evincent/pod/dewplayer.swf?son=<?php print $mp3 ?>"> 
											<param name="movie" value="http://web.sfc.keio.ac.jp/%7Evincent/pod/dewplayer.swf?son=<?php print $mp3 ?>" /> 
										</object>
										&nbsp;
										<a href="<?php print $mp3 ?>" target="_blank" onclick="suspendTicker()">mp3-Datei &ouml;ffnen</a>
										<?php
											$dauer = $item["itunesDuration"];
											if (isset($dauer) && "" != trim($dauer)) {
												print "&nbsp;Dauer: $dauer";
											}
										?>							
									</div>
									<?php
								}	
							}
							?>
						</div>
						<div style="display:block"><input type="button" value="per Email verschicken" style="float:right" onclick="toggleShareNewsForm()"/></div>	
					</td>
				</tr>
			</table>
		</div>
	<?php
}
?>