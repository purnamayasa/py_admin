<?php

ini_set("display_errors", 1);

session_start();

if (!isset($_SESSION["rbac_loggedin"]) || $_SESSION["rbac_loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$new_password = isset($_SESSION["new_password"]) ? $_SESSION["new_password"] : '';
$confirm_password = isset($_SESSION["confirm_password"]) ? $_SESSION["confirm_password"] : '';

$new_password_err = isset($_SESSION["new_password_err"]) ? $_SESSION["new_password_err"] : '';
$confirm_password_err = isset($_SESSION["confirm_password_err"]) ? $_SESSION["confirm_password_err"] : '';
?>

<?php require_once "template/default/header.php"; ?>

<h2>Reset Password</h2>
<p>Silahkan ketikkan informasi Anda untuk reset password.</p>
<form action="reset_password_process.php" method="post"> 
    <table>
        <tr>
            <td>Password baru</td>
            <td>:</td>
            <td>
                <input type="password" name="new_password" value="<?php echo $new_password; ?>">
                <?php echo $new_password_err; ?>
            </td>
        </tr>
        <tr>
            <td>Konfirmasi Password</td>
            <td>:</td>
            <td>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <?php echo $confirm_password_err; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" name="submit" value="reset">Reset</button>
                <a href="index.php">Batal</a>
            </td>
        </tr>
    </table>
</form>

<?php require_once "template/default/footer.php"; ?>

<?php

$_SESSION["new_password"] = "";
$_SESSION["confirm_password"] = "";

$_SESSION["new_password_err"] = "";
$_SESSION["confirm_password_err"] = "";