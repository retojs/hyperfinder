<?php
/**
 * Diese Datei enthält verschiedene Varianten, um per PHP
 * Daten an ein POST-formular zu schicken und das Resultat auszugeben.
 */

include ("../util/postRequest.php");
?>

<?php
# usage:
#  $r = post_it($postdata, 'http://fahrplan.sbb.ch/bin/query.exe/dn?');
#  echo $r->DownloadToString();

function post_it($postdata, $url) {

	$url = str_replace("http://", "", $url);
	$url .= "/";
	$host = substr($url, 0, strpos($url, "/"));
	$uri = strstr($url, "/");

	$reqbody = "";
	foreach($postdata as $key => $val) {
		if (!empty($reqbody)) $reqbody .= "&";
		$reqbody .= $key."=".urlencode($val);
	}

	$contentlength = strlen($reqbody);
	$reqheader = 	"POST $uri HTTP/1.1\r\n".
	"Host: $host\r\n".
	"User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)\r\n".
	"Content-Type: application/x-www-form-urlencoded\r\n".
	"Content-Length: $contentlength\r\n\r\n".
	"$reqbody\r\n";

	$socket = fsockopen($host, 80, $errno, $errstr);

	if (!$socket) {
		$result["errno"] = $errno;
		$result["errstr"] = $errstr;
		return $result;
	}

	fputs($socket, $reqheader);
	while (!feof($socket)) {
		$result[] = fgets($socket, 4096);
	}
	fclose($socket);

	$result_str = "";
	foreach($result as $r) {
		$result_str .= $r;
	}
	return $result_str;
}
?>

<?php

// siehe: http://ch2.php.net/manual/de/wrappers.http.php

// Funktioniert nicht...
// Mit der alten PHP version auf dem Webserver erst recht nicht...

function post_modern($postdata, $url) {

	$queryString = http_build_query($postdata);

	$opts = array('HTTP' =>
	array(
	'method'  => 'POST',
	'header'  =>	"Content-type: application/x-www-form-urlencoded\r\n" .
	"Content-length: " . strlen($queryString) . "\r\n\r\n" ,
	'content' => $queryString,
	)
	);

	// ???
	//$context = context_create_stream($opts);
	//$context = stream_context_get_default($opts);
	$context = stream_context_create($opts);

	// ???
	//$result = fopen($url, "r", false, $context);
	//$result = file_get_contents($url, false, $context);
	//$result = readfile($url, false, $context);

	$fp = @fopen($url, 'rb', false, $context);
	if (!$fp) {
		print "Problem with $url, $php_errormsg";
	}
	$result = @stream_get_contents($fp);
	if ($result === false) {
		print "Problem reading data from $url, $php_errormsg";
	}

	return $result;
}
?>

<?php

if (!$this->postRedirect) {

	$r = new HTTPRequest($this->url);
	$result = $r->DownloadToString($this->postArgs);

	//$result = post_it($this->postArgs, $this->url);
	//$result = post_modern($this->postArgs, $this->url);

	// update relative links
	$relUrl = substr($this->url, 0, strrpos($this->url, "/"));

	$result = str_replace("href=\"/", "xxxx=\"". $this->urlBase ."/", $result);
	$result = str_replace("href='/", "xxxx='". $this->urlBase ."/", $result);
	$result = str_replace("href=/", "xxxx=". $this->urlBase ."/", $result);
	$result = str_replace("href=\"http", "xxxx=\"http", $result);
	$result = str_replace("href='http", "xxxx='http", $result);
	$result = str_replace("href=http", "xxxx=http", $result);
	$result = str_replace("href=\"#", "xxxx=\"#", $result);
	$result = str_replace("href='#", "xxxx='#", $result);
	$result = str_replace("href=#", "xxxx=#", $result);
	$result = str_replace("href=\"", "xxxx=\"". $relUrl ."/", $result);
	$result = str_replace("href='", "xxxx='". $relUrl ."/", $result);
	$result = str_replace("href=", "href=". $relUrl ."/", $result);
	$result = str_replace("xxxx=", "href=", $result);

	$result = str_replace("src=\"/", "yyy=\"". $this->urlBase ."/", $result);
	$result = str_replace("src='/", "yyy='". $this->urlBase ."/", $result);
	$result = str_replace("src=/", "yyy=". $this->urlBase ."/", $result);
	$result = str_replace("src=\"http", "yyy=\"http", $result);
	$result = str_replace("src='http", "yyy='http", $result);
	$result = str_replace("src=http", "yyy=http", $result);
	$result = str_replace("src=\"", "yyy=\"". $relUrl ."/", $result);
	$result = str_replace("src='", "yyy='". $relUrl ."/", $result);
	$result = str_replace("src=", "src=". $relUrl ."/", $result);
	$result = str_replace("yyy=", "src=", $result);

	print substr($result, strpos($result, "<"));

} else {

	/**
	 * Version mit redirect.
	 *  Nachteil: Back-button funktioniert so nicht.
	 *  Vorteil: Links stimmen. Bei Seiten, die Pfade per Javascript setzen, ist der Ansatz mit str_replace aussichtslos.
	 */
	?>
<body onload="f.submit()">
<form name="f" action="<?php print $this->url ?>" method="post"><?php foreach ($this->postArgs as $argName => $argValue) {
	print "<input type=\"hidden\" name=\"$argName\" value=\"$argValue\">\n";
} ?> Anfrage an <i><?php print $this->url; ?></i> wird ausgeführt... <input type="submit" value="submit" /></form>
</body>
<?php } ?>