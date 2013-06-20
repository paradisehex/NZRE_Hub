<?php
ob_start();
session_start();
//Check if session is admin.
if(!$_SESSION['name']){
	header("location:/Ingress");
}else{
	// Connect to server and select databse.
	include "/var/www/Ingress/Tools/database.php";
	include "/var/www/Ingress/Tools/permission.php";
	include "/var/www/Ingress/Tools/log.php";
	include "/var/www/Ingress/Tools/register.php";
		
	if(IsOfficer($con,$_SESSION['name'])){

		// Define $myusername and $mypassword  and protect againest MYSQL injection
		$myusername=stripslashes(str_replace ("&#65279","",$_POST['TheUserName']));
		$mypassword=md5($_POST['ThePassword3']);
		$mypassword2=md5($_POST['ThePassword2']);
		$level=stripslashes($_POST['Level']);

		//See if passwords match
		if($mypassword==$mypassword2){

			//See if user name is taken
			$sql="SELECT * FROM AgentTable WHERE username='$myusername'";
			$result=mysqli_query($con,$sql);
			$count=mysqli_num_rows($result);

			// If count equals 0 the username isn't taken
			if($count==0){
				if($level!=null){
					register($con,$myusername,$mypassword,$level);
					header("location:/Ingress/Users/Agents");
				}else{
					echo "Requies lvl";
				}
			}
			else {
				echo "User name taken";
			}
		}
		else{
			echo "Passwords don't match";
		}
	}else{
		header("location:/Ingress");
	}
}
?>
