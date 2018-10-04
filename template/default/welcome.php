<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
<p>Selamat datang di aplikasi.</p>
<p>
    <a href="reset_password.php" class="btn btn-warning">Reset password Anda</a><br>
    <a href="logout.php" class="btn btn-danger">Sign Out akun Anda</a>
</p>