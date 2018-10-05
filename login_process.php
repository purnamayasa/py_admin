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

            $stmt->bind_param("s", $param_username);
            
            $param_username = $username;
            
            if ($stmt->execute()) {

                $stmt->store_result();
                
                if ($stmt->num_rows() == 1) {     

                    $stmt->bind_result($user_id, $username, $hashed_password);

                    if ($stmt->fetch()) {

                        if (password_verify($password, $hashed_password)) {                            

                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["password"] = $hashed_password;   
                            
                            header("location: index.php");
                            exit;

                        } else {

                            $_SESSION["password_err"] = "Password yang Anda ketikan tidak sesuai.";

                        }
                    }
                } else {

                    $_SESSION["username_err"] = "Tidak ditemukan akun dengan username ini.";

                }
            } else {

                echo "Terjadi kesalahan, silahkan coba lagi!.";
                exit;

            }

            $stmt->close();

        }
                
    }
    
    mysqli_close($link);

    header("location: login.php");
    exit;
    
}