<?php
session_start();
if(!$_SESSION['admin']){header("location:/Ingress");return;}

// Connect to server and select databse.
include $_SESSION['path']."/Tools/database.php";
include $_SESSION['path']."/Tools/log.php";
include $_SESSION['path']."/Tools/register.php";

// Define $myusername and $mypassword  and protect againest MYSQL injection
$myusername=stripslashes(str_replace ("&#65279","",$_POST['TheUserName']));
$mypassword = $_POST['ThePassword3'];
$mypassword2 = $_POST['ThePassword2'];
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
			header("location:/Ingress/Admin");
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
?>
