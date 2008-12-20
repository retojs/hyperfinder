<?php

$cmds["en"] = createGetCmd("http://pda.leo.org/?lp=ende&lang=de&searchLoc=0&cmpType=relaxed&relink=on&sectHdr=on&spellToler=std&search=arg0");
$cmds["fr"] = createGetCmd("http://pda.leo.org/?lp=frde&search=arg0");
$cmds["es"] = createGetCmd("http://pda.leo.org/?lp=esde&search=arg0");

$cmds["sbb"] = createPostCmd("http://fahrplan.sbb.ch/bin/query.exe/dox?OK#focus", "http://fahrplan.sbb.ch", array (
	"REQ0HafasInitialSelection" => "0",
	"REQ0JourneyStopsS0A" => "1",
	"REQ0JourneyStopsS0G" => "arg0",
	"REQ0JourneyStopsS0ID" => "",
	"REQ0JourneyStopsZ0ID" => "",
	"REQ0JourneyStopsZ0A" => "1",
	"REQ0JourneyStopsZ0G" => "arg1",
	"REQ0JourneyDate" => "arg2",
	"REQ0JourneyTime" => "arg3",
	"start" => "Suchen"
));

?>