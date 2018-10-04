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
	<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
	<p>Selamat datang di aplikasi.</p>
	<p>
	    <a href="reset_password.php" class="btn btn-warning">Reset password Anda</a><br>
	    <a href="logout.php" class="btn btn-danger">Sign Out akun Anda</a>
	</p>
<?php } else { ?>
	<?php require_once 'template/default/error_permission.php'; ?>
<?php } ?>

<?php require_once "template/default/footer.php"; ?>