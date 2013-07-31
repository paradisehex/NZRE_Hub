<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/password.php";

		$username = $_SESSION['name'];
		$oldpassword= $_POST['OldPassword'];
		$newpassword = $_POST['NewPassword'];
		$newpassword2 = $_POST['NewPassword2'];

		
		if(checkPassword($username,$oldpassword,$con)){
			if($newpassword==$newpassword2){
				$HashedPW = getHash($username,$newpassword);
				$sql2 = "UPDATE AgentTable SET password = '' WHERE username = '".$username."'";
				mysqli_query($con,$sql2);

				$sql2 = "UPDATE AgentTable SET passwordHash = '".$HashedPW."' WHERE username = '".$username."'";
				mysqli_query($con,$sql2);

				header("location:/Ingress/Users");
			}else{
				echo "Passwords don't match";
			}
		}else{
			echo "Wrong Password";
		}
?>
