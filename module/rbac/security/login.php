<?php

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
$username_err = isset($_SESSION["username_err"]) ? $_SESSION["username_err"] : "";
$password_err = isset($_SESSION["password_err"]) ? $_SESSION["password_err"] : "";
?>

<?php require_once "template/default/header.php"; ?>

<form action="index.php?module=rbac/security&action=login-process" method="post">
    <h2>Login</h2>
    <p>Silahkan ketikan informasi akun Anda.</p>
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
                <input type="password" name="password">
                <?php echo $password_err; ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><button type="submit" name="submit" value="login">Login</button></td>
        </tr>
    </table>
    <p>Tidak memiliki login? <a href="index.php?module=rbac/security&action=register">Daftar sekarang</a>.</p>
</form>

<?php require_once "template/default/footer.php"; ?>

<?php

$_SESSION["username"] = "";
$_SESSION["username_err"] = "";
$_SESSION["password_err"] = "";