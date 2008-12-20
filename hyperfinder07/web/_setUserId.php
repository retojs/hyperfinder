<html>
<head>
<title>User-ID setzen</title>
<script type="text/javascript" src="js/js2.2.js"></script>	
<script type="text/javascript" >
function setUserId() {
	var useridElem = document.getElementById('userid');
	if (useridElem != null) {
		createCookie(cookie_userId, useridElem.value, 90);
		// verify settings through page reload
		document.location.href = "_setUserId.php?confirm=do";
	}	
}

var cookie_enableUserCommands = "enableUserCommands";

function enableUserCommands() {
	var cbox = document.getElementById('enableUserCommands');
	if (cbox.checked) {
		createCookie(cookie_enableUserCommands, "true", 90);
	} else {
		eraseCookie(cookie_enableUserCommands);
	}
}
function initPage() {
	var cbox = document.getElementById('enableUserCommands');
	cbox.checked = ("true" == readCookie(cookie_enableUserCommands));
}
</script>
</head>
<body onload="initPage()">
<h2>User-ID setzen</h2>
<?php
if (isset($_REQUEST["confirm"])) {
	print "<p><b>User-ID wurde gesetzt auf: " . $_COOKIE["userid"] . "</b></p>";
}
?>
<p>Das hyperfinder cookie Namens "userid" auf diesem Rechner auf eine bestimmte user-ID setzen.</p> 
<form action="_setUserId.php" method="POST">
	user-ID: <input type="text" name="userid" id="userid" value="<?php print $_COOKIE["userid"]; ?>">
	<input type="button" value="setzen" onclick="setUserId()">
</form>

<h2>Custom user commands verwenden</h2>
<input type="checkbox" id="enableUserCommands" onclick="enableUserCommands()"> Custom user commands verwenden

<h2>Custom user commands editieren</h2>
<a href="cmd/user.php">Editor</a>
<body>
</html>

<!-- 

TODO:

Schritt 1: DB-modell definieren: 

 TABLE Commands = userid, cmd, method, url, params

Schritt 2: Editor schreiben

 Editor form:
  - enable custom commands (checkbox) 
  - New button / Select from List (needs to be loaded from DB)
  - Form fields for cmd, method, url, params
    options (radio): params as list of names or via URL
  - Save / Delete buttons

 Editor form handler: Operations
 
  - clear form
  - load command list
  - load command
  - save command
  - delete command


Schritt 3: Integration in do.php

 falls enabled und noch nicht in session: alle commands aus DB in session laden und ebenfalls berücksichtigen


Schritt 4: User settings unter Email Adresse abspeichern.

 -->