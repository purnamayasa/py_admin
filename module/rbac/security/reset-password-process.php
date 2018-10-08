<?php

$_SESSION["new_password"] = $confirm_password = "";
$_SESSION["new_password_err"] = $confirm_password_err = "";

if (isset($_POST["submit"]) && $_POST["submit"] == 'reset') {
 
    if (empty(trim($_POST["new_password"]))) {

        $_SESSION["new_password_err"] = "Silahkan ketikan password Anda.";

    } else {

        $_SESSION["new_password"] = trim($_POST["new_password"]);

        if (strlen(trim($_SESSION["new_password"])) < 6) {

            $_SESSION["new_password_err"] = "Password harus minimal 6 karakter.";

        }        

    }
    
    if (empty(trim($_POST["confirm_password"]))) {

        $_SESSION["confirm_password_err"] = "Silahkan ketikan ulang password Anda.";

    } else {

        $_SESSION["confirm_password"] = trim($_POST["confirm_password"]);

        if ($_SESSION["new_password"] !== $_SESSION["confirm_password"]) {
            $_SESSION["confirm_password_err"] = "Password yang Anda konfirmasi tidak sama.";
        }
    }
    
    if (empty($_SESSION["new_password_err"]) && empty($_SESSION["confirm_password_err"])) {

        $sql = "UPDATE user SET password = ? WHERE user_id = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {

            echo 3;

            $stmt->bind_param("si", $param_password, $param_user_id);
            
            $param_password = password_hash($_SESSION["new_password"], PASSWORD_DEFAULT);
            $param_user_id = $_SESSION["rbac_user_id"];
            
            if ($stmt->execute()) {

                header("location: index.php?module=rbac/security&action=logout");
                exit();

            } else {

                echo "Terjadi kesalahan, silahkan coba lagi!.";
                exit;

            }

            $stmt->close();

        }
                
    }
    
    mysqli_close($link);

    header("location: index.php?module=rbac/security&action=reset-password");
    exit;

}