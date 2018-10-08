<?php

$security = array(
	"rbac/security"
);


if (isset($_SESSION["rbac_loggedin"]) && $_SESSION["rbac_loggedin"] !== true) {

	if ($module == "rbac/security") {

		if ($action === "reset-password") {

			header("location: index.php?module=rbac/security&action=login");
    		exit;

		}

	} else {

		header("location: index.php?module=rbac/security&action=login");
    	exit;

	}

} else if (!isset($_SESSION["rbac_loggedin"])) {

	if ($module == "rbac/security") {

		if ($action === "reset-password") {

			header("location: index.php?module=rbac/security&action=login");
    		exit;
		}

	} else {

		header("location: index.php?module=rbac/security&action=login");
    	exit;

	}
}

