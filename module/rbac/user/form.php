<?php
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
$password = isset($_SESSION["password"]) ? $_SESSION["password"] : '';
$confirm_password = isset($_SESSION["confirm_password"]) ? $_SESSION["confirm_password"] : '';

$username_err = isset($_SESSION["username_err"]) ? $_SESSION["username_err"] : '';
$password_err = isset($_SESSION["password_err"]) ? $_SESSION["password_err"] : '';
$confirm_password_err = isset($_SESSION["confirm_password_err"]) ? $_SESSION["confirm_password_err"] : '';
?>

<form action="index.php?module=rbac/user&action=save" method="post">
	<table>
		<tr>
			<td>Id User</td>
			<td>:</td>
			<td><input type="" name="user_id" value=""></td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td>
				<input type="" name="username" value="">
				<?php echo $username_err; ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td>
				<input type="" name="password" value="">
				<?php echo $password_err; ?>
			</td>
		</tr>
		<tr>
			<td>Konfirmasi Password</td>
			<td>:</td>
			<td>
				<input type="" name="confirm_password" value="">
				<?php echo $confirm_password_err; ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><button type="submit" name="submit" value="save">Simpan</button></td>
		</tr>
	</table>
</form>