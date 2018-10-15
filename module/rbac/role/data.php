<?php if ($rbac->hasPrivilege("rbac.role.crud.create")) { ?>

	<?php crud_data_button_create("index.php?module=rbac/role&action=create"); ?>

<?php } ?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">

	<tr>
		<th>#</th>
		<th>Role Id</th>
		<th>Role Name</th>
		<th width="1">Aksi</th>
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

	$no = 1;
	?>

	<?php if ($stmt = mysqli_prepare($link, $sql)) { ?>

		<?php if ($stmt->execute()) { ?>

			<?php $stmt->store_result(); ?>

			<?php if ($stmt->num_rows() > 0) { ?>

				<?php $stmt->bind_result($role_id, $role_name); ?>

				<?php while ($row = $stmt->fetch()) { ?>

					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $role_id; ?></td>
						<td><?php echo $role_name; ?></td>
						<td>
							<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
								<?php 
								crud_data_option_select();

								if ($rbac->hasPrivilege("rbac.role.crud.update")) {
									
									crud_data_option_update("index.php?module=rbac/role&action=update&role_id=" . $role_id);

								}

								if ($rbac->hasPrivilege("rbac.role.crud.delete")) {
									
									crud_data_option_delete("index.php?module=rbac/role&action=delete&role_id=" . $role_id);

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