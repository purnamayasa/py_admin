<p><a href="<?php echo "index.php?module=rbac/user&action=create"; ?>">Tambah</a></p>

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
			user_id, username, password, email_address 
		FROM 
			user
	";
	?>

	<?php if ($stmt = mysqli_prepare($link, $sql)) { ?>

		<?php if ($stmt->execute()) { ?>

			<?php $stmt->store_result(); ?>

			<?php if ($stmt->num_rows() > 0) { ?>

				<?php $stmt->bind_result($user_id, $username, $password, $email_address); ?>

				<?php while ($row = $stmt->fetch()) { ?>

					<tr>
						<td></td>
						<td><?php echo $user_id; ?></td>
						<td><?php echo $username; ?></td>
						<td><?php echo $password; ?></td>
						<td><?php echo $email_address; ?></td>
						<td>
							<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
								<option value="">-PILIH-</option>
								<option value="<?php echo "index.php?module=rbac/user&action=update&user_id=" . $user_id; ?>">Ubah</option>
								<option value="">Hapus</option>
							</select>
						</td>
					</tr>

				<?php } ?>

			<?php } ?>

		<?php } ?>

	<?php }	?>

</table>