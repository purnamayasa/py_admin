<?php
 
$username = "";
$password = "";
$confirm_password = "";

$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["confirm_password"] = "";
$_SESSION["username_err"] = "";
$_SESSION["password_err"] = "";
$_SESSION["confirm_password_err"] = "";
 

if (isset($_POST["submit"]) && $_POST["submit"] == 'daftar') {

    if (empty(trim($_POST["username"]))) {

        $_SESSION["username_err"] = "Silahkan ketikan username Anda.";

    } else {

        $sql = "SELECT user_id FROM user WHERE username = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {

            $stmt->bind_param("s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if ($stmt->execute()) {

                $stmt->store_result();
                
                if ($stmt->num_rows() == 1) {

                    $_SESSION["username_err"] = "username ini sudah digunakan.";
                    
                } else{

                    $username = trim($_POST["username"]);
                    $_SESSION["username"] = $username;

                }

            } else{

                echo "Terjadi kesalahan, silahkan coba lagi!.";
                exit;

            }

            $stmt->close();

        }

    }
    
    if (empty(trim($_POST["password"]))) {

        $_SESSION["password_err"] = "Silahkan ketikan password Anda.";  

    } else if (strlen(trim($_POST["password"])) < 6) {

        $_SESSION["password_err"] = "Password harus minimal 6 karakter.";

    } else {
        $password = trim($_POST["password"]);
        $_SESSION["password"] = $password;
    }
    
    if (empty(trim($_POST["confirm_password"]))) {

        $_SESSION["confirm_password_err"] = "Silahkan ketikan ulang password Anda.";     

    } else {

        $confirm_password = trim($_POST["confirm_password"]);
        $_SESSION["confirm_password"] = $confirm_password;

        if (empty($password_err) && ($password != $confirm_password)) {

            $_SESSION["confirm_password_err"] = "Password yang Anda konfirmasi tidak sama.";

        }
    }
    
    if (empty($_SESSION["username_err"]) && empty($_SESSION["password_err"]) && empty($_SESSION["confirm_password_err"])) {
        
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
         
        if ($stmt = mysqli_prepare($link, $sql)) {

            $stmt->bind_param("ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if ($stmt->execute()) {

                header("location: index.php?module=rbac/security&action=login");
                exit;

            } else{

                echo "Terjadi kesalahan, silahkan coba lagi!.";
                exit;

            }

            $stmt->close();

        }
                 
    }
    
    mysqli_close($link);

    header("location: index.php?module=rbac/security&action=register");
    exit;

}