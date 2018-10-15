<?php

$role_id = isset($_GET["role_id"]) ? $_GET["role_id"] : "";

$role_name = isset($_SESSION["role_name"]) ? $_SESSION["role_name"] : "";

$role_name_err = isset($_SESSION["role_name_err"]) ? $_SESSION["role_name_err"] : "";

$sql = "SELECT t1.role_id, t1.role_name FROM role AS t1 WHERE t1.role_id = ?";

$result_role_id = "";
$result_role_name = "";

if ($stmt = mysqli_prepare($link, $sql)) {

	$stmt->bind_param("i", $param_role_id );

	$param_role_id  = $role_id ;

	 if ($stmt->execute()) {

	 	$stmt->store_result();

	 	if ($stmt->num_rows() > 0) {

	 		$stmt->bind_result($result_role_id , $result_role_name);

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


<form action="<?php echo "index.php?module=rbac/role&action=save&form=" . $action . "&role_id=" . $role_id; ?>" method="post">
	<table>
		<?php if ($action === 'create') { ?>
			
		<?php } else if ($action === 'update') {  ?>

			<tr>
				<td>Role Id</td>
				<td>:</td>
				<td>
					<?php echo $result_role_id; ?>
					<input type="hidden" name="role_id" value="<?php echo $result_role_id; ?>">
				</td>
			</tr>

		<?php } ?>
		<tr>
			<td>Role Name</td>
			<td>:</td>
			<td>
				<input type="text" name="role_name" value="<?php echo $result_role_name; ?>">
				<?php echo $role_name_err; ?>
			</td>
		</tr>

		<?php if ($action === 'update') { ?>
			<tr valign="top">
				<td>Permission</td>
				<td>:</td>
				<td>
					<table width="100%" border="1" cellpadding="0" cellspacing="0">

						<tr>
							<th>Permission Id</th>
							<th>Permission Name</th>
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

						?>

						<?php if ($stmt = mysqli_prepare($link, $sql)) { ?>

							<?php if ($stmt->execute()) { ?>

								<?php $stmt->store_result(); ?>

								<?php if ($stmt->num_rows() > 0) { ?>

									<?php $stmt->bind_result($permission_id, $permission_name); ?>

									<?php while ($row = $stmt->fetch()) { ?>

										<tr>
											<td><?php echo $permission_id; ?></td>
											<td><?php echo $permission_name; ?></td>
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

$_SESSION["role_name_err"] = "";