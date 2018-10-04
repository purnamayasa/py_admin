<?php

ini_set("display_errors", 1);

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit;
}

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
$username_err = isset($_SESSION["username_err"]) ? $_SESSION["username_err"] : "";
$password_err = isset($_SESSION["password_err"]) ? $_SESSION["password_err"] : "";
?>

<form action="login_process.php" method="post">
    <h2>Login</h2>
    <p>Silahkan ketikan informasi login Anda.</p>
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
    <p>Tidak memiliki login? <a href="register.php">Daftar sekarang</a>.</p>
</form>

<?php

$_SESSION["username"] = "";
$_SESSION["username_err"] = "";
$_SESSION["password_err"] = "";