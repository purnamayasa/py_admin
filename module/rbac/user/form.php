<?php
$user_id = isset($_GET["user_id"]) ? $_GET["user_id"] : '';

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
$password = isset($_SESSION["password"]) ? $_SESSION["password"] : '';
$confirm_password = isset($_SESSION["confirm_password"]) ? $_SESSION["confirm_password"] : '';

$username_err = isset($_SESSION["username_err"]) ? $_SESSION["username_err"] : '';
$password_err = isset($_SESSION["password_err"]) ? $_SESSION["password_err"] : '';
$confirm_password_err = isset($_SESSION["confirm_password_err"]) ? $_SESSION["confirm_password_err"] : '';

$sql = "SELECT t1.user_id, t1.username, t1.password, t1.email_address FROM user AS t1 WHERE t1.user_id = ?";

$result_user_id = "";
$result_username = "";
$result_password = "";
$result_email_address = "";

if ($stmt = mysqli_prepare($link, $sql)) {

	$stmt->bind_param("i", $param_user_id);

	$param_user_id = $user_id;

	 if ($stmt->execute()) {

	 	$stmt->store_result();

	 	if ($stmt->num_rows() > 0) {

	 		$stmt->bind_result($result_user_id, $result_username, $result_password, $result_email_address);

	 		if ($stmt->fetch()) {


	 		}  else {


	 		}	

	 	} else {
	 		

	 	}

	} else {


	}

} else {

}
?>

<form action="<?php echo "index.php?module=rbac/user&action=save&form=" . $action . "&user_id=" . $user_id; ?>" method="post">
	<table>
		<?php if ($action === 'create') { ?>
			
		<?php } else if ($action === 'update') {  ?>

			<tr>
				<td>Id User</td>
				<td>:</td>
				<td>
					<?php echo $result_user_id; ?>
					<input type="hidden" name="user_id" value="<?php echo $result_user_id; ?>">
				</td>
			</tr>
			

		<?php } ?>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td>
				<?php if ($action === 'create') { ?>

					<input type="text" name="username" value="<?php echo $result_username; ?>">
					<?php echo $username_err; ?>

				<?php } else if ($action === 'update') {  ?>

					<input type="hidden" name="username" value="<?php echo $result_username; ?>">
					<?php echo $result_username; ?>

				<?php } ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td>
				<input type="password" name="password" value="<?php echo $result_password; ?>">
				<?php echo $password_err; ?>
			</td>
		</tr>
		<tr>
			<td>Konfirmasi Password</td>
			<td>:</td>
			<td>
				<input type="password" name="confirm_password" value="<?php echo $result_password; ?>">
				<?php echo $confirm_password_err; ?>
			</td>
		</tr>
		<?php if ($action === 'update') { ?>
			<tr valign="top">
				<td>Role</td>
				<td>:</td>
				<td>
					<table width="100%" border="1" cellpadding="0" cellspacing="0">

						<tr>
							<th>Role Id</th>
							<th>Role Name</th>
						</tr>

						<?php
						$sql = "
							SELECT 
								t1.role_id, t1.role_name
							FROM 
								role AS t1
							ORDER BY
								t1.role_name
						";
						?>

						<?php if ($stmt = mysqli_prepare($link, $sql)) { ?>

							<?php if ($stmt->execute()) { ?>

								<?php $stmt->store_result(); ?>

								<?php if ($stmt->num_rows() > 0) { ?>

									<?php $stmt->bind_result($role_id, $role_name); ?>

									<?php while ($row = $stmt->fetch()) { ?>

										<tr>
											<td><?php echo $role_id; ?></td>
											<td><?php echo $role_name; ?></td>
										</tr>

									<?php } ?>

								<?php }  else { ?>

									<tr>
										<td colspan="6">Data tidak ditemukan</td>
									</tr>

								<?php } ?>

							<?php } ?>

						<?php }	?>

					</table>
				</td>
			</tr>
		<?php } ?>
		<tr>
			<td></td>
			<td></td>
			<td><?php crud_form_button_save(); ?></td>
		</tr>
	</table>
</form>

<?php

$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["confirm_password"] = "";

$_SESSION["username_err"] = "";
$_SESSION["password_err"] = "";
$_SESSION["confirm_password_err"] = "";