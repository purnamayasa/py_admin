<table>
	<tr>
		<th>#</th>
		<th>Id Permissi</th>
		<th>Nama Permisi</th>
	</tr>

	<?php
	$sql = "SELECT user_id, username, password FROM user";
        
    if ($stmt = mysqli_prepare($link, $sql)) {
       
        
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) > 0) {     

                mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password);

                if (mysqli_stmt_fetch($stmt)) {

                    
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
    ?>
    
</table>