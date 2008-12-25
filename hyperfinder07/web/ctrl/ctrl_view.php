<?php


$content = $_REQUEST["content"];
print $result;

print "base: ". substr($content, 0, strrpos($content, "/")). "<br/>";
//print "<script type=\"text/javascript\" src=\"../js/ctrl.js\"></script>";
//print "<script type=\"text/javascript\">replaceLinks('" . substr($content, 0, strrpos($content, "/")) . "')</script>";
?>
