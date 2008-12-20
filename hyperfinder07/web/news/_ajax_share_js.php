<?php

$link = $_REQUEST["link"];
$to= $_REQUEST["to"];
$from= $_REQUEST["from"];
$msg= $_REQUEST["msg"];

// print "got: $to $from $msg $link ";

if (isset($to) && $to != "" && isset($from) && $from != "") {
	$from_header = "From: news@hyperfinder.ch";
	$message = "$from schickt ihnen via hyperfinder.ch den folgenden Artikel:\n\n $link ";
	$subject = "Ein Artikel, der Sie interessieren könnte";
	if (isset($msg) && $msg != "" ) {
		$message .= "\n\nSeine Nachricht dazu:\n\n " . $msg . "";
		$subject = substr($msg, 0, 64);
	}
	
	mail($to, $subject, $message, $from_header);
	
	print "ok";

} else {
	if (!isset($to) || $to == "") {
		print "noTo";
	} else if (!isset($from) || $from == "") {
		print "noFrom";
	} 
}

?>