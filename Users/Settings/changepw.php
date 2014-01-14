<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/password.php";
		include $_SESSION['path']."/Tools/alert.php";

		$username = $_SESSION['name'];
		$oldpassword= $_POST['OldPassword'];
		$newpassword = $_POST['NewPassword'];
		$newpassword2 = $_POST['NewPassword2'];

		
		if(checkPassword($username,$oldpassword)){
			if($newpassword==$newpassword2){
				$HashedPW = getHash($username,$newpassword);

				update("AgentTable", array("passwordHash"), array($HashedPW), "username", $username);

				notifyMsg("Password changed to </div><div style=\"color: #FFFFFF;\">".$HashedPW."</div><div id=\"Line\">(that's the hash not the actual password)", "./");
			}else{
				errorMsg("Passwords don't match","./");
			}
		}else{
			errorMsg("Wrong Old Password","./");
		}
?>
