<?php

if ($action == "save") {

	if (isset($_POST["submit"]) && $_POST["submit"] == 'save') {

		$_SESSION["user_id"] = isset($_GET["user_id"]) ? $_GET["user_id"] : "";

		$_SESSION["username"] = "";
		$_SESSION["password"] = "";
		$_SESSION["confirm_password"] = "";

		$_SESSION["username_err"] = "";
		$_SESSION["password_err"] = "";
		$_SESSION["confirm_password_err"] = "";

		if (empty(trim($_POST["username"]))) {

        	$_SESSION["username_err"] = "Silahkan ketikan username Anda.";

	    } else {

	    	if ($_GET["form"] === "create") {

	    		$sql = "SELECT user_id FROM user WHERE username = ? LIMIT 1";
	        
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("s", $param_username);
		            
		            $param_username = trim($_POST["username"]);
		            
		            if ($stmt->execute()) {

		                $stmt->store_result();
		                
		                if ($stmt->num_rows() > 0) {

		                    $_SESSION["username_err"] = "username ini sudah digunakan.";
		                    
		                } else{

		                    $_SESSION["username"] = trim($_POST["username"]);

		                }

		            } else{

		                echo "Terjadi kesalahan, silahkan coba lagi!.";
		                exit;

		            }

		            $stmt->close();

		        }

	    	} else if ($_GET["form"] === "update") {

	    		$_SESSION["username"] = trim($_POST["username"]);

	    	}

	    }
	    
	    if (empty(trim($_POST["password"]))) {

	        $_SESSION["password_err"] = "Silahkan ketikan password Anda.";  

	    } else if (strlen(trim($_POST["password"])) < 6) {

	        $_SESSION["password_err"] = "Password harus minimal 6 karakter";

	    } else {

	        $_SESSION["password"] = trim($_POST["password"]);
	    
	    }
	    
	    if (empty(trim($_POST["confirm_password"]))) {

	        $_SESSION["confirm_password_err"] = "Silahkan ketikan konfirmasi password Anda.";     

	    } else {

	        $_SESSION["confirm_password"] = trim($_POST["confirm_password"]);

	        if ($_SESSION["password"] != $_SESSION["confirm_password"]) {

	            $_SESSION["confirm_password_err"] = "Password tidak sama.";

	        }
	    }

		if (empty($_SESSION["username_err"]) && empty($_SESSION["password_err"]) && empty($_SESSION["confirm_password_err"])) {

			if ($_GET["form"] === "create") {

				$sql = "INSERT INTO user (username, password) VALUES (?, ?)";
	         
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("ss", $param_username, $param_password);
		            
		            $param_username = $_SESSION["username"];
		            $param_password = password_hash($_SESSION["password"], PASSWORD_DEFAULT);
		            
		            if ($stmt->execute()) {

		                header("location: index.php?module=rbac/user&action=data");
		                exit;

		            } else{

		                echo "Terjadi kesalahan, silahkan coba lagi!.";
		                exit;

		            }

		            $stmt->close();

		        }

			} else if ($_GET["form"] === "update") {

				$sql = "UPDATE user  SET password = ? WHERE user_id = ?";
	         
		        if ($stmt = mysqli_prepare($link, $sql)) {

		            $stmt->bind_param("si", $param_password, $param_user_id);
		            		            
		            $param_password = password_hash($_SESSION["password"], PASSWORD_DEFAULT);
		            $param_user_id = $_SESSION["user_id"];
		            
		            if ($stmt->execute()) {

		                header("location: index.php?module=rbac/user&action=data");
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
	    	
	    	header("location: index.php?module=rbac/user&action=create&user_id=" . $_SESSION["user_id"]);

	    } else if ($_GET["form"] === "update") {

	    	header("location: index.php?module=rbac/user&action=update&user_id=" . $_SESSION["user_id"]);

	    }

	    exit;

	}

}