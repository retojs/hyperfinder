<?php

if (strtolower($_SERVER["HTTP_HOST"]) == 'localhost') {
	$SERVER_ROOT = "http://localhost/hyperfinder07/cmd/";
} else {
	$SERVER_ROOT = "http://cmd.hyperfinder.ch/";
}

$headline = "Meine Kommandos";
$feedback = "<p>Hier können Sie Ihre eigenen Kommandos definieren. Drücken Sie dazu auf <i>Neu</i></p>";
$commandSet = "";

require_once ("_db_email.php");
require_once ("_db_cmd.php");
require_once ("../_db_userdata.php");
		
require_once ("_email_action.php");

require_once ("_editor.php");
require_once ("_editor_action.php");
require_once ("_editor_view.php");

require_once ("_embedMe_action.php");
?>

<script type="text/Javascript">
function $(id) {
	return document.getElementById(id);
}
function enable(id) {
	setEnabled(id, false);
}
function disable(id) {
	setEnabled(id, true);
}
function setEnabled(id, enabled) {
	if (id != null && $(id) != null) {
		$(id).disabled = enabled;
	}
}
</script>