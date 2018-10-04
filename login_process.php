<?php

ini_set("display_errors", 1);

session_start();
 
require_once "config/database.php";
 
$username = "";
$password = "";

$_SESSION["username"] = "";
$_SESSION["password"] = "";
$_SESSION["username_err"] = "";
$_SESSION["password_err"] = "";
 
if (isset($_POST["submit"]) && $_POST["submit"] == 'login') {
 
    if (empty(trim($_POST["username"]))) {

        $_SESSION["username_err"] = "Silahkan ketikan username Anda.";

    } else {

        $username = trim($_POST["username"]);
        $_SESSION["username"] = $username;

    }
    
    if (empty(trim($_POST["password"]))) {

        $_SESSION["password_err"] = "Silahkan ketikan password Anda.";

    } else {

        $password = trim($_POST["password"]);
        $_SESSION["password"] = $password;

    }

    if (empty($_SESSION["username_err"]) && empty($_SESSION["password_err"])) {

        $sql = "SELECT user_id, username, password FROM user WHERE username = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);
                
                if (mysqli_stmt_num_rows($stmt) == 1) {     

                    mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {

                        if (password_verify($password, $hashed_password)) {                            

                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["password"] = $hashed_password;   
                            
                            header("location: index.php");
                            exit;
                        } else {

                            $_SESSION["password_err"] = "Password yang Anda ketikkan tidak sesuai.";

                        }
                    }
                } else {

                    $_SESSION["username_err"] = "Tidak ditemukan login dengan username ini.";

                }
            } else {

                echo "Terjadi kesalahan, silahkan coba lagi!.";
                exit;

            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
}

header("location: login.php");
exit;