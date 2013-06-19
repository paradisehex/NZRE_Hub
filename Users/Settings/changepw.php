<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$username=$_SESSION['name'];
		$oldpassword=md5($_POST['OldPassword']);
		$newpassword=md5($_POST['NewPassword']);
		$newpassword2=md5($_POST['NewPassword2']);

		$sql="SELECT * FROM AgentTable WHERE username='$username' and password='$oldpassword'";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);

		// If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1){
			if($newpassword==$newpassword2){
				$sql2 = "UPDATE AgentTable SET password = '".$newpassword."' WHERE username = '".$username."'";
				mysqli_query($con,$sql2);
				header("location:/Ingress/Users");
			}else{
				echo "Passwords don't match";
			}
		}else{
			echo "Wrong Password";
		}
	}
?>
