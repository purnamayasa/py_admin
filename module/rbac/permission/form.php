<?php

$permission_id = isset($_GET["permission_id"]) ? $_GET["permission_id"] : "";

$permission_name = isset($_SESSION["permission_name"]) ? $_SESSION["permission_name"] : "";

$permission_name_err = isset($_SESSION["permission_name_err"]) ? $_SESSION["permission_name_err"] : "";

$sql = "SELECT t1.permission_id, t1.permission_name FROM permission AS t1 WHERE t1.permission_id = ?";

$result_permission_id = "";
$result_permission_name = "";

if ($stmt = mysqli_prepare($link, $sql)) {

	$stmt->bind_param("i", $param_permission_id );

	$param_permission_id  = $permission_id ;

	 if ($stmt->execute()) {

	 	$stmt->store_result();

	 	if ($stmt->num_rows() > 0) {

	 		$stmt->bind_result($result_permission_id , $result_permission_name);

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


<form action="<?php echo "index.php?module=rbac/permission&action=save&form=" . $action . "&permission_id=" . $permission_id; ?>" method="post">
	<table>
		<?php if ($action === 'create') { ?>
			
		<?php } else if ($action === 'update') {  ?>

			<tr>
				<td>Permission Id</td>
				<td>:</td>
				<td>
					<?php echo $result_permission_id; ?>
					<input type="hidden" name="permission_id" value="<?php echo $result_permission_id; ?>">
				</td>
			</tr>

		<?php } ?>
		<tr>
			<td>Permission Name</td>
			<td>:</td>
			<td>
				<input type="text" name="permission_name" value="<?php echo $result_permission_name; ?>">
				<?php echo $permission_name_err; ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><button type="submit" name="submit" value="save">Simpan</button></td>
		</tr>
	</table>
</form>

<?php

$_SESSION["permission_name_err"] = "";