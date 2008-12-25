<?php

include("_ajax_polling_controller_js.php");

$content = "http://" . getForward($key);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<script type="text/javascript" src="../js/ctrl.js"></script>
<title>IPhone Remote</title>
</head>
<body onload="setPollControllerTimeout()">
<h3>Browser Controller</h3>

<form action="controller.php" method="POST"><label>KEY:</label> <input type="text" name="key"
	value="<?php if (isset($key)) { print $key;}?>" /> <br />
<label>URL: http://</label> <input type="text" style="width: 400px" name="forward"
	value="<?php if (isset($forward)) print $forward; ?>" />
<button type="submit" name="setForward">Go!</button>

<div>forward set to: <?php print $content; ?></div>
</form>

<iframe id="content_frame" name="content_frame" src="<?php print $content ?>" width="100%" height="900px"></iframe>

</body>
</html>
