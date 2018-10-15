<?php if ($rbac->hasPrivilege("rbac.permission.crud.create")) { ?>

	<?php crud_data_button_create("index.php?module=rbac/permission&action=create"); ?>

<?php } ?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">

	<tr>
		<th>#</th>
		<th>Permission Id</th>
		<th>Permission Name</th>
		<th width="1">Aksi</th>
	</tr>

	<?php
	$sql = "
		SELECT 
			t1.permission_id, t1.permission_name
		FROM 
			permission AS t1
		ORDER BY
			t1.permission_name
	";

	$no = 1;
	?>

	<?php if ($stmt = mysqli_prepare($link, $sql)) { ?>

		<?php if ($stmt->execute()) { ?>

			<?php $stmt->store_result(); ?>

			<?php if ($stmt->num_rows() > 0) { ?>

				<?php $stmt->bind_result($permission_id, $permission_name); ?>

				<?php while ($row = $stmt->fetch()) { ?>

					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $permission_id; ?></td>
						<td><?php echo $permission_name; ?></td>
						<td>
							<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
								<?php 
								crud_data_option_select();

								if ($rbac->hasPrivilege("rbac.role.crud.update")) {
									
									crud_data_option_update("index.php?module=rbac/permission&action=update&permission_id=" . $permission_id);

								}

								if ($rbac->hasPrivilege("rbac.role.crud.delete")) {
									
									crud_data_option_delete("index.php?module=rbac/permission&action=delete&permission_id=" . $permission_id);

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