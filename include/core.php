<?php

require_once "config/database.php";
require_once "include/rbac.php";

$module = isset($_GET["module"]) ? $_GET["module"] : "";