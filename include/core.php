<?php

require_once "config/database.php";
require_once "function/crud.php";
require_once "include/rbac.php";

$module = isset($_GET["module"]) ? $_GET["module"] : "";
$module_array = explode("/", $module);
$module_count = count($module_array);

if ($module_count > 1) {

	$module_file = "module" . "/" . $module . "/" . $module_array[$module_count - 1] . ".php";	

} else {

	$module_file = "";
	
}

$action = isset($_GET["action"]) ? $_GET["action"] : "";