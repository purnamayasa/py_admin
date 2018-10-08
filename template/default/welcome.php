<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["rbac_username"]); ?></b>.</h1>
<p>Selamat datang di aplikasi.</p>
<p>
    <a href="index.php?module=rbac/security&action=reset-password">Reset password Anda</a><br>
    <a href="index.php?module=rbac/security&action=logout">Sign Out akun Anda</a>
</p>