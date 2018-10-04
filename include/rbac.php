<?php

require_once "class/Role.php";
require_once "class/User.php";
require_once "class/PrivilegedUser.php";

if (isset($_SESSION["username"])) {
	$pu = new PrivilegedUser($link);
    $rbac = $pu->getByUsername($_SESSION["username"]);
}