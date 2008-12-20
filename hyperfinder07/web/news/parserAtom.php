<?php

// code to parse an XML file inspired from http://www.sitepoint.com/print/560

function parseAtom($url) {

	// Create an XML parser
	$xml_parser = xml_parser_create();

	// Set the functions to handle opening and closing tags
	xml_set_element_handler($xml_parser, "startElement", "endElement");

	// Set the function to handle blocks of character data
	xml_set_character_data_handler($xml_parser, "characterData");

	// Open the XML file for reading
	$fp = fopen($url, "r")
		   or die("Error reading RSS data.");

	// Read the XML file 4KB at a time
	while ($data = fread($fp, 4096))
	   // Parse each 4KB chunk with the XML parser created above
	   xml_parse($xml_parser, $data, feof($fp))
		   // Handle errors in parsing
		   or die(sprintf("XML error: %s at line %d",
			   xml_error_string(xml_get_error_code($xml_parser)),
			   xml_get_current_line_number($xml_parser)));

	// Close the XML file
	fclose($fp);

	// Free up memory used by the XML parser
	xml_parser_free($xml_parser);

}

// organizazional variables
$insidentry = false;
$tag = "";

// result array of entries
$ENTRIES;

// sub-elements of each entry
$title;
$link_href;
$id;
$updated;
$summary;

function startElement($parser, $tagName, $attrs) {

	global $insidentry, $tag;
	global $link_href;

	if ($insidentry) {
		$tag = $tagName;

		// read attributes of certain tags
		switch ($tag) {
			case "LINK":
				$link_href = $attrs["HREF"];
			break;
		}
	}

	elseif ($tagName == "ENTRY") {
       $insidentry = true;
	}

}

function endElement($parser, $tagName) {

	global $insidentry, $tag;
	global $ENTRIES;
	global $title;
	global $link_href;
	global $id;
	global $updated;
	global $summary;

	if ($tagName == "ENTRY") {

		// store the item
		$entry["title"] = $title;
		$entry["link_href"] = $link_href;
		$entry["id"] = $id;
		$entry["updated"] = $updated;
		$entry["summary"] = $summary;
		if (trim($title) != "") {
			$ENTRIES[] = $entry;
		}
		
		$title = "";
		$link_href = "";
		$id = "";
		$updated = "";
		$summary = "";

		$insidentry = false;
	}

}

function characterData($parser, $data) {

	global $insidentry, $tag;
	global $title;
	global $id;
	global $updated;
	global $summary;

	if ($insidentry) {
		$data = utf8_decode($data);
		switch ($tag) {
			case "TITLE":
				$title .= $data;
			break;
			case "ID":
				$id .= $data;
			break;
			case "UPDATED":
				$updated .= $data;
			break;
			case "SUMMARY":
				$summary .= $data;
			break;

		}

	}

}

function toString($array) {
	foreach ($array as $key => $entry) {
		echo " key " . $key . " entry " . $entry . "<br>";
		foreach ($entry as $ikey => $ivalue) {
			echo " key " . $ikey . " = " . $ivalue . "<br>";
		}
	}
}

?>

