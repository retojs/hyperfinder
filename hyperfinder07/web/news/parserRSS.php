<?php

// Falls true, werden die Daten des feeds per utf8_decode konvertiert.
$utf8Decode = true;

function readEncoding($url) {
	
	$fp = fopen($url, "rb")
	   or die("Error reading RSS data.");
	$data = fread($fp, 4096);

	// does not work... $encoding = mb_detect_encoding($data, 'UTF-8, ISO-8859-1');
	
	$rx = "/<?xml.*encoding=['\"](.*?)['\"].*?>/m";
	if (preg_match($rx, $data, $m)) {
	  $encoding = strtoupper($m[1]);
	}
	fclose($fp);
	
	return $encoding;
}

// code to parse an XML file inspired from http://www.sitepoint.com/print/560
function parseRSS($url, $utf8) {
	
	// use utf8_decode if (a) the encoding is specified as utf-8 in the feed or (b) if the argument $utf8 is set to "y" 
	global $utf8Decode;	
	$encoding = readEncoding($url);
	if (isset($encoding)) {
		$utf8Decode = (strcasecmp($encoding, "UTF-8") == 0);
	} else {
		$utf8Decode = ($utf8 === "y");
	}
	
	// print "utf8: $utf8 - encoding: $encoding - decode: $utf8Decode ";
	
	// Create an XML parser
	// see http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
	if (strcasecmp($encoding, "utf-8") == 0) {
		$xml_parser = xml_parser_create("UTF-8");
	} else if (strcasecmp($encoding, "ISO-8859-1") == 0) {
		$xml_parser = xml_parser_create("ISO-8859-1");
	} else {
		$xml_parser = xml_parser_create("");
	}
	//$xml_parser = xml_parser_create();
	//xml_parser_set_option($xml_parser, XML_OPTION_TARGET_ENCODING, "utf-8");
	//xml_parser_set_option($xml_parser, XML_OPTION_TARGET_ENCODING, "ISO-8859-1");
	
	// Set the functions to handle opening and closing tags
	xml_set_element_handler($xml_parser, "startElement", "endElement");

	// Set the function to handle blocks of character data
	xml_set_character_data_handler($xml_parser, "characterData");
	
	// Open the XML file for reading
	$fp = fopen($url, "rb") // $fp = fopen($url, "r")
		   or die("Error reading RSS data."); // !! Don't change this string! Client checks for it...

	// Read the XML file 4KB at a time
	while ($data = fread($fp, 4096)) {
		// & und – irritieren den parser...
		// caused "invalid token"... $data = str_replace ("–", "-", $data);
		$data = str_replace ("&#x96;", "-", $data);
		$data = str_replace ("&#8211;", "-", $data);
		// caused "invalid token"... $data = str_replace ("’", "x", $data);
		$data = str_replace ("&#8217;", "'", $data);
		$data = str_replace ("&#8216;", "'", $data);
		// caused "invalid token"... $data = str_replace ("„", "\"", $data);
		// caused "invalid token"... $data = str_replace ("“", "\"", $data);
		$data = str_replace ("&#171;", "\"", $data);
		$data = str_replace ("&#187;", "\"", $data);
		$data = str_replace ("&#8220;", "\"", $data);
		$data = str_replace ("&#8221;", "\"", $data);
		
		/* another hack from http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss 
		if(function_exists('mb_convert_encoding')) {
			print "function_exists. ";
			$encoded_source = @mb_convert_encoding($data, "UTF-8", $encoding);
		}
		if($encoded_source != NULL) {
			print "not null. ";
			$data = str_replace ( $m[0],'<?xml version="1.0" encoding="utf-8"?>', $encoded_source);
		}
		*/
		
		// Parse each 4KB chunk with the XML parser created above
		xml_parse($xml_parser, $data, feof($fp))
			// Handle errors in parsing
			or die(sprintf("XML error: %s at line %d", 
				xml_error_string(xml_get_error_code($xml_parser)),
				xml_get_current_line_number($xml_parser)));
	}
	// Close the XML file
	fclose($fp);
	
	// Parser scheint das deklarierte encoding nicht zu erkennen...
	// print "encoding: ". xml_parser_get_option($xml_parser, XML_OPTION_TARGET_ENCODING);

	// Free up memory used by the XML parser
	xml_parser_free($xml_parser);

}

// organizazional variables
$insideitem = false;
$tag = "";

// result array of items
$ITEMS;

// sub-elements of each item
$title = "";
$description = "";
$link = "";
$author = "";
$pubDate = "";
$enclosure_url = "";
$enclosure_type = "";
$itunesAuthor = "";
$itunesSubtitle = "";
$itunesDuration = "";

function startElement($parser, $tagName, $attrs) {

	global $insideitem, $tag;
	global $enclosure_url, $enclosure_type;

	// If $insideitem is true, it means we're going to want to take note of the tag that is starting
	// so we know what to do with the character data it contains, which will trigger a call to characterData next.
	// So we record the name of the tag ($tagName) in our global $tag variable:

	if ($insideitem) {
		$tag = $tagName;

		// read attributes of certain tags
		switch ($tag) {
			case "ENCLOSURE":
				$enclosure_type = $attrs["TYPE"];
				$enclosure_url = $attrs["URL"];
			break;
		}

	}

	// If, on the other hand, we're not inside an <item> tag,
	// then the only opening tag that we could possibly be interested in would be an actual <item> tag,
	// in which case we would set $insideitem to true to indicate that we were entering one of these tags:

	elseif ($tagName == "ITEM") {
       $insideitem = true;
	}

}

function endElement($parser, $tagName) {

	global $insideitem, $tag;
	global $ITEMS;
	global $title;
	global $description;
	global $link;
	global $author;
	global $pubDate;
	global $enclosure_url;
	global $enclosure_type;
	global $itunesAuthor;
	global $itunesSubtitle;
	global $itunesDuration;

	if ($tagName == "ITEM") {

		// store the item
		$item["title"] = $title;
		$item["description"] = $description;
		$item["link"] = $link;
		$item["author"] = $author;
		$item["pubDate"] = $pubDate;
		$item["enclosure_url"] = $enclosure_url;
		$item["enclosure_type"] = $enclosure_type;
		$item["itunesAuthor"] = $itunesAuthor;
		$item["itunesSubtitle"] = $itunesSubtitle;
		$item["itunesDuration"] = $itunesDuration;
		if (trim($title) != "") {
			$ITEMS[] = $item;
		}
		
		$title = "";
		$description = "";
		$link = "";
		$author = "";
		$pubDate = "";
		$enclosure_url = "";
		$enclosure_type = "";
		$itunesAuthor = "";
		$itunesSubtitle = "";
		$itunesDuration = "";

		// And then finally set $insideitem to false to indicate to our other functions that we are no longer inside an <item> tag.

		$insideitem = false;
	}

}

function characterData($parser, $data) {

	global $insideitem, $tag;
	global $title;
	global $description;
	global $link;
	global $author;
	global $pubDate;
	global $itunesAuthor;
	global $itunesSubtitle;
	global $itunesDuration;
	
	global $utf8Decode;

	// This function requires access to all five of our global variables.
	// Now, as before, the only time we are interested in the character data in the XML file is
	// when we are inside an <item> tag, so the first step again is to check if that is the case:

	if ($insideitem) {

		// Now, there are three different tags that can appear inside <item> tags that we are interested in:
		// <title>, <description> and <link>.

		if ($utf8Decode) {
			$data = utf8_decode($data);
		}
		
		switch ($tag) {
			case "TITLE":
				$title .= $data;
			break;
			case "DESCRIPTION":
				$description .= $data;
			break;
			case "LINK":
				$link .= $data;
			break;
			case "AUTHOR":
				$author .= $data;
			break;
			case "PUBDATE":
				$pubDate .= $data;
			break;
			case "ITUNES:AUTHOR":
				$itunesAuthor .= $data;
			break;
			case "ITUNES:SUBTITLE":
				$itunesSubtitle .= $data;
			break;
			case "ITUNES:DURATION":
				$itunesDuration .= $data;
			break;

		}

		// Note that we append (.=) the $data to the variable in question,
		// rather than simply assigning it (=) because the contents of a single tag
		// can be received as several consecutive characterData events.

	}
}

function toString($array) {
	foreach ($array as $key => $item) {
		echo " key " . $key . " items " . $item . "<br>";
		foreach ($item as $ikey => $ivalue) {
			echo " key " . $ikey . " = " . $ivalue . "<br>";
		}
	}
}

?>

