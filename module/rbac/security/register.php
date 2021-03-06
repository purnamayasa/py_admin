<?php

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
$password = isset($_SESSION["password"]) ? $_SESSION["password"] : '';
$confirm_password = isset($_SESSION["confirm_password"]) ? $_SESSION["confirm_password"] : '';

$username_err = isset($_SESSION["username_err"]) ? $_SESSION["username_err"] : '';
$password_err = isset($_SESSION["password_err"]) ? $_SESSION["password_err"] : '';
$confirm_password_err = isset($_SESSION["confirm_password_err"]) ? $_SESSION["confirm_password_err"] : '';
?>

<?php require_once "template/default/header.php"; ?>

<h2>Daftar</h2>
<p>Silahkan ketik informasi Anda untuk membuat akun.</p>
<form action="index.php?module=rbac/security&action=register-process" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <?php echo $username_err; ?>
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <?php echo $password_err; ?>
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
                <button type="submit" name="submit" value="daftar">Daftar</button>
                <button type="reset" name="reset" value="reset">Reset</button>
            </td>
        </tr>
    </table>
    <p>Sudah punya akun? <a href="index.php?module/rbac/security&action=login">Login disini</a>.</p>
</form>

<?php require_once "template/default/footer.php"; ?>

<?php

$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["confirm_password"] = "";

$_SESSION["username_err"] = "";
$_SESSION["password_err"] = "";
$_SESSION["confirm_password_err"] = "";