<?php 
/** 
 * Returns the file specified with the file request parameter in zipped format. 
 */
ob_start("ob_gzhandler");
$version = "2.5";
$files["js.js"] = "js/js".$version.".js";
$files["news.js"] = "js/news".$version.".js";
$file = $_GET["file"];
include ($files[$file]);
?>