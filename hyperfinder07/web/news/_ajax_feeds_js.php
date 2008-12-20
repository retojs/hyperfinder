<?php

header("Content-Type: text/html; charset=iso-8859-1");

// call by URL like:
//  _ajax_feeds_js.php?mode=byTopic&select=bg

// if (isset($select)) :
//   Gibt die newsfeeds für select2 in JSON zurück, und zwar als Array von Objekten
//   mit den Werten key (z.B. "2"), label (z.B. "NZZ - Ausland") und tempo (z.B. "6000"): 
//      [{key: ..., label: ..., tempo: ...}, {...}, ...]
// else :
//   Gibt die Liste für select1 in JSON zurück, ebenfalls als Array von Objekten
//   Mit den Werten key (z.B. "nzz") und label (z.B. "NZZ"):
//      [{key: ..., label: ...}, {...}, ...]

require_once("feedList.php");

function printNewsList($newslist, $select) {
	print "[";
	$separator = "";
	if (!isset($select)) {
		foreach($newslist as $key => $value) {
			print $separator . "{key: \"".$key."\", label: \"".$newslist[$key]["name"]."\"}";
			$separator = ", ";		
		}
	
	} else {
		foreach($newslist[$select] as $key => $feed) {
			if ($key === "name") continue;
			print $separator . "{key: \"".$key."\", label: \"$feed->text\", tempo: \"$feed->tickerTempo\"}";
			$separator = ", ";
		}
	}
	print "]";
}

$mode = $_REQUEST["mode"];
$select = $_REQUEST["select"];

if (isset($mode)) {
	printNewsList($feeds[$mode], $select);
}

?>