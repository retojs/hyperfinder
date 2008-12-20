<?php
function createGetCmd($url) {
	return new Command("get", $url, $url, null);
}

function createPostCmd($url, $urlBase, $postArgs) {
	return new Command("post", $url, $urlBase, $postArgs);
}

function createLink($url) {
	return new Command("link", $url, $url, null);
}

/**
 * A Command instance has
 * - a request method (either GET or POST),
 * - a target URL
 * - an array of post arguments if it´s a POST request
 */
class Command {

	var $args = array (
	"<1>",
	"<2>",
	"<3>",
	"<4>",
	"<5>",
	"<6>",
	"<7>"
	);

	var $method;
	var $url;
	var $urlBase; // where to start from with relative links
	var $postArgs;
	var $postRedirect = true; // if true the post request is redirected via the client browser. (see: post.php)

	function Command($method, $url, $urlBase, $postArgs) {
		$this->method = $method;
		$this->url = $url;
		$this->urlBase = $urlBase;
		$this->postArgs = $postArgs;
	}

	function printUrl() {
		print $this->url;
	}

	/** Remove whitespace from each argument. */
	function trimArgs($args) {
		for ($i = 0; $i < sizeof($args); $i++) {
			$args[$i] = trim($args[$i]);
		}
		return $args;
	}

	/**
	 * Replaces the "argn" values of the array postArgs
	 * with the nth value of the specified array.
	 * E.g. a postArgs array:
	 *   a=>bla, b=>arg0, c=>arg1
	 * filled with the array:
	 *   0 =>reto, 1=>lamprecht
	 * will be modified to:
	 *   a=>bla, b=>reto, c=>lamprecht
	 */
	function fillPostParams($args) {
		for ($i = 0; $i < sizeof($args); $i++) {
			foreach ($this->postArgs as $argName => $argValue) {
				if ($argValue == "<" . ($i + 1) . ">") {
					$this->postArgs[$argName] = $args[$i];
				}
			}
		}
	}

	/** Executes the command which is either
	 * - a link
	 * - a get request (argn strings are replaced by the specified args)
	 * - a post requet (dito)
	 */
	function execRequest($args) {
		$args = $this->trimArgs($args);

		if ($this->method == "link") {
			header("Location: " . $this->url);
		}
		elseif ($this->method == "get") {
			$url = str_replace($this->args, $args, $this->url);
			header("Location: $url");
		}
		elseif ($this->method == "post") {
			$this->fillPostParams($args);
			include ("post.php");
		} else {
			print "no method specified";
		}
	}
}
?>
