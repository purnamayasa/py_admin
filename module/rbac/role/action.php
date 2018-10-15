<?php

if ($action == "save") {

	if (isset($_POST["submit"]) && $_POST["submit"] == 'save') {

		$_SESSION["role_id"] = isset($_GET["role_id"]) ? $_GET["role_id"] : "";

		$_SESSION["role_name"] = "";

		if (empty(trim($_POST["role_name"]))) {

        	$_SESSION["role_name_err"] = "Silahkan ketikan role name.";

	    } else {

	    	if ($_GET["form"] === "create") {

	    		$sql = "SELECT role_id FROM role WHERE role_name = ? LIMIT 1";
	        
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("s", $param_role_name);
		            
		            $param_role_name = trim($_POST["role_name"]);
		            
		            if ($stmt->execute()) {

		                $stmt->store_result();
		                
		                if ($stmt->num_rows() > 0) {

		                    $_SESSION["role_name_err"] = "role name ini sudah digunakan.";
		                    
		                } else{

		                    $_SESSION["role_name"] = trim($_POST["role_name"]);

		                }

		            } else{

		                echo "Terjadi kesalahan, silahkan coba lagi!.";
		                exit;

		            }

		            $stmt->close();

		        }

	    	} else if ($_GET["form"] === "update") {

	    		$_SESSION["role_name"] = trim($_POST["role_name"]);

	    	}

	    }

	    if (empty($_SESSION["role_name_err"])) {

	    	if ($_GET["form"] === "create") {

				$sql = "INSERT INTO role (role_name) VALUES (?)";
	         
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("s", $param_role_name);
		            
		            $param_role_name = $_SESSION["role_name"];
		            
		            if ($stmt->execute()) {

		                header("location: index.php?module=rbac/role&action=data");
		                exit;

		            } else{

		                echo "Terjadi kesalahan, silahkan coba lagi!.";
		                exit;

		            }

		            $stmt->close();

		        }

			} else if ($_GET["form"] === "update") {

				$sql = "UPDATE role  SET role_name = ? WHERE role_id = ?";
	         
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("si", $param_role_name, $param_role_id);
		            		            
		            $param_role_name = $_SESSION["role_name"];
		            $param_role_id = $_SESSION["role_id"];
		            
		            if ($stmt->execute()) {

		                header("location: index.php?module=rbac/role&action=data");
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
	    	
	    	header("location: index.php?module=rbac/role&action=create&role_id=" . $_SESSION["role_id"]);

	    } else if ($_GET["form"] === "update") {

	    	header("location: index.php?module=rbac/role&action=update&role_id=" . $_SESSION["role_id"]);

	    }

	    exit;

	}

}