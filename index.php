<?php

ini_set("display_errors", 1);

session_start();

require_once "include/core.php";
require_once "include/security.php";

require_once "template/default/header.php";

if (empty($module_file)) {

	require_once "template/default/welcome.php";

} else if (file_exists($module_file)) {

	require_once $module_file;

} else {

	require_once "template/default/error_404.php";

}

require_once "template/default/footer.php";