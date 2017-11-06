<?php 
/** 
   Returns the file specified with the file request parameter in zipped format.

   NOTE: Currently not used because it breaks browser debugging

 */
ob_start("ob_gzhandler");
$version = "2.8.1";
$files["js.js"] = "js/js".$version.".js";
$files["news.js"] = "js/news".$version.".js";
$file = $_GET["file"];
include ($files[$file]);
?>