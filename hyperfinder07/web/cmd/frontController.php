<?php
// page definitions
$pages['help'] = "help.php";
$pages['user'] = "user/index.php";

// dispatch request
$BASE_URL = "index.php?page=" . $_GET['page'] . "&";
include($pages[$_GET['page']]);
?>