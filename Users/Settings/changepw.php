<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/password.php";

		$username = $_SESSION['name'];
		$oldpassword= $_POST['OldPassword'];
		$newpassword = $_POST['NewPassword'];
		$newpassword2 = $_POST['NewPassword2'];

		
		if(checkPassword($username,$oldpassword)){
			if($newpassword==$newpassword2){
				$HashedPW = getHash($username,$newpassword);

				update("AgentTable", array("passwordHash"), array($HashedPW), "username", $username);

				header("location:/Ingress/Users");
			}else{
				echo "Passwords don't match";
			}
		}else{
			echo "Wrong Password";
		}
?>
