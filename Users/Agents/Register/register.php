<?php
	session_start();
	
	// Connect to server and select databse.
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/log.php";
	include $_SESSION['path']."/Tools/register.php";
		
	if(IsOfficer($con,$_SESSION['name'])){

		// Define $myusername and $mypassword  and protect againest MYSQL injection
		$myusername=stripslashes(str_replace ("&#65279","",$_POST['TheUserName']));
		$mypassword = $_POST['ThePassword3'];
		$mypassword2 =$_POST['ThePassword2'];
		$level=stripslashes($_POST['Level']);

		//See if passwords match
		if($mypassword==$mypassword2){

			//See if user name is taken
			$result = selectFrom("AgentTable", array("username"), array($myusername));
			$count=mysqli_num_rows($result);

			// If count equals 0 the username isn't taken
			if($count==0){
				if($level!=null){
					register($myusername,$mypassword,$level);
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
?>
