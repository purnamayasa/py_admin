<?php if (isset($_SESSION["rbac_username"])) { ?>
	<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["rbac_username"]); ?></b>.</h1>
<?php } ?>
<p>
    Halaman ini tidak ditemukan.
</p>