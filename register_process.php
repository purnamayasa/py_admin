<?php

ini_set("display_errors", 1);

session_start();

require_once "config/database.php";
 
$username = "";
$password = "";
$confirm_password = "";

$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["confirm_password"] = "";
$_SESSION["username_err"] = "";
$_SESSION["password_err"] = "";
$_SESSION["confirm_password_err"] = "";
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {

        $_SESSION["username_err"] = "Silahkan ketikan username Anda.";

    } else {

        $sql = "SELECT user_id FROM user WHERE username = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);
                
                if (mysqli_stmt_num_rows($stmt) == 1) {

                    $_SESSION["username_err"] = "username ini sudah diguankan.";
                } else{

                    $username = trim($_POST["username"]);
                    $_SESSION["username"] = $username;

                }

            } else{

                echo "Terjadi kesalahan, silahkan coba lagi!.";
                exit;

            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    if (empty(trim($_POST["password"]))) {

        $_SESSION["password_err"] = "Silahkan ketikan password Anda.";  

    } else if (strlen(trim($_POST["password"])) < 6) {

        $_SESSION["password_err"] = "Password minimal harus 6 karakter";

    } else {
        $password = trim($_POST["password"]);
        $_SESSION["password"] = $password;
    }
    
    if (empty(trim($_POST["confirm_password"]))) {

        $_SESSION["confirm_password_err"] = "Silahkan ketikan konfirmasi password Anda.";     

    } else {

        $confirm_password = trim($_POST["confirm_password"]);
        $_SESSION["confirm_password"] = $confirm_password;

        if (empty($password_err) && ($password != $confirm_password)) {

            $_SESSION["confirm_password_err"] = "Password tidak sama.";

        }
    }
    
    if (empty($_SESSION["username_err"]) && empty($_SESSION["password_err"]) && empty($_SESSION["confirm_password_err"])) {
        
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
         
        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if (mysqli_stmt_execute($stmt)) {

                header("location: login.php");

            } else{

                echo "Terjadi kesalahan, silahkan coba lagi!.";
                exit;

            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}

header("location: register.php");
exit;