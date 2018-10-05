<?php

require_once "config/database.php";
require_once "include/rbac.php";

$module = isset($_GET["module"]) ? $_GET["module"] : "";
$module_array = explode("/", $module);
$module_count = count($module_array);

if (empty($module)) {
	$module_file = "";
} else {
	$module_file = "module" . "/" . $module . "/" . $module_array[$module_count - 1] . ".php";
}

$action = isset($_GET["action"]) ? $_GET["action"] : "";