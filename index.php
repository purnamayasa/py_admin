<?php

ini_set("display_errors", 1);

session_start();

require_once "include/core.php";
 
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<?php require_once "template/default/header.php"; ?>

<?php if ($rbac->hasPrivilege("index")) { ?>	
	<?php
	if (file_exists($module_file)) {
		require_once $module_file;
	} else if (empty($module_file)) {
		require_once "template/default/welcome.php";
	} else {
		require_once "template/default/error_404.php";
	}
	?>
<?php } else { ?>
	<?php require_once "template/default/error_permission.php"; ?>
<?php } ?>

<?php require_once "template/default/footer.php"; ?>