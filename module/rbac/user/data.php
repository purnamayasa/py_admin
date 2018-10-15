<?php if ($rbac->hasPrivilege("rbac.user.crud.create")) { ?>

	<?php crud_data_button_create("index.php?module=rbac/user&action=create"); ?>

<?php } ?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">

	<tr>
		<th>#</th>
		<th>Id User</th>
		<th>Username</th>
		<th>Password</th>
		<th>Email</th>
		<th width="1">Aksi</th>
	</tr>

	<?php
	$sql = "
		SELECT 
			t1.user_id, t1.username, t1.password, t1.email_address 
		FROM 
			user AS t1
		ORDER BY
			t1.username
	";

	$no = 1;
	?>

	<?php if ($stmt = mysqli_prepare($link, $sql)) { ?>

		<?php if ($stmt->execute()) { ?>

			<?php $stmt->store_result(); ?>

			<?php if ($stmt->num_rows() > 0) { ?>

				<?php $stmt->bind_result($user_id, $username, $password, $email_address); ?>

				<?php while ($row = $stmt->fetch()) { ?>

					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $user_id; ?></td>
						<td><?php echo $username; ?></td>
						<td><?php echo $password; ?></td>
						<td><?php echo $email_address; ?></td>
						<td>
							<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
								<?php 
								crud_data_option_select();
								
								if ($rbac->hasPrivilege("rbac.user.crud.update")) {
								
									crud_data_option_update("index.php?module=rbac/user&action=update&user_id=" . $user_id);
								
								}

								if ($rbac->hasPrivilege("rbac.user.crud.delete")) {
								
									crud_data_option_delete("index.php?module=rbac/user&action=delete&user_id=" . $user_id);

								} 
								?>
							</select>
						</td>
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