<?php require_once ("_util.php"); ?>

<?php
$op = (isset($_REQUEST["op"]))? "'".$_REQUEST["op"]."'" : null;
$arg1 = (isset($_REQUEST["arg1"]))? ", '".$_REQUEST["arg1"]."'" : null;
$arg2 = (isset($_REQUEST["arg2"]))? ", '".$_REQUEST["arg2"]."'" : null;
$arg3 = (isset($_REQUEST["arg3"]))? ", '".$_REQUEST["arg3"]."'" : null;
$arg4 = (isset($_REQUEST["arg4"]))? ", '".$_REQUEST["arg4"]."'" : null;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<?php printHTMLHeader(false) ?>
	<body onLoad="initPage(<?php print "$op $arg1 $arg2 $arg3 $arg4"; ?>)">
		<form id="pageform" action="" target="" method="post" onSubmit="return gotoURL()">
			<div align="center">
				<noscript>
				<h1><div style="color:#a00">Damit hyperfinder funktioniert, muss Javascript aktiviert sein.</div></h1>
				</noscript>
				<div id="mainpage">
					<?php require_once ("maintable.php"); ?>
				</div>
			</div>
			<img src="img/leer.gif" height="350" width="2"/>
		</form>
		<?php include ("analyticsTracking.php"); ?>
	</body>
</html>
