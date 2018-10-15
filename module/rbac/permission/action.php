<?php

if ($action == "save") {

	if (isset($_POST["submit"]) && $_POST["submit"] == 'save') {

		$_SESSION["permission_id"] = isset($_GET["permission_id"]) ? $_GET["permission_id"] : "";

		$_SESSION["permission_name"] = "";

		if (empty(trim($_POST["permission_name"]))) {

        	$_SESSION["permission_name_err"] = "Silahkan ketikan permission name.";

	    } else {

	    	if ($_GET["form"] === "create") {

	    		$sql = "SELECT permission_id FROM permission WHERE permission_name = ? LIMIT 1";
	        
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("s", $param_permission_name);
		            
		            $param_permission_name = trim($_POST["permission_name"]);
		            
		            if ($stmt->execute()) {

		                $stmt->store_result();
		                
		                if ($stmt->num_rows() > 0) {

		                    $_SESSION["permission_name_err"] = "permission name ini sudah digunakan.";
		                    
		                } else{

		                    $_SESSION["permission_name"] = trim($_POST["permission_name"]);

		                }

		            } else{

		                echo "Terjadi kesalahan, silahkan coba lagi!.";
		                exit;

		            }

		            $stmt->close();

		        }

	    	} else if ($_GET["form"] === "update") {

	    		$_SESSION["permission_name"] = trim($_POST["permission_name"]);

	    	}

	    }

	    if (empty($_SESSION["permission_name_err"])) {

	    	if ($_GET["form"] === "create") {

				$sql = "INSERT INTO permission (permission_name) VALUES (?)";
	         
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("s", $param_permission_name);
		            
		            $param_permission_name = $_SESSION["permission_name"];
		            
		            if ($stmt->execute()) {

		                header("location: index.php?module=rbac/permission&action=data");
		                exit;

		            } else{

		                echo "Terjadi kesalahan, silahkan coba lagi!.";
		                exit;

		            }

		            $stmt->close();

		        }

			} else if ($_GET["form"] === "update") {

				$sql = "UPDATE permission  SET permission_name = ? WHERE permission_id = ?";
	         
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("si", $param_permission_name, $param_permission_id);
		            		            
		            $param_permission_name = $_SESSION["permission_name"];
		            $param_permission_id = $_SESSION["permission_id"];
		            
		            if ($stmt->execute()) {

		                header("location: index.php?module=rbac/permission&action=data");
		                exit;

		            } else{

		                echo "Terjadi kesalahan, silahkan coba lagi!.";
		                exit;

		            }

		            $stmt->close();

		        }

			}

	    }

	    mysqli_close($link);

	    if ($_GET["form"] === "create") {
	    	
	    	header("location: index.php?module=rbac/permission&action=create&permission_id=" . $_SESSION["permission_id"]);

	    } else if ($_GET["form"] === "update") {

	    	header("location: index.php?module=rbac/permission&action=update&permission_id=" . $_SESSION["permission_id"]);

	    }

	    exit;

	}

}