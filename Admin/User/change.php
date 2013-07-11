<?php
	session_start();
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/password.php";

		$username = strip_tags(stripslashes($_POST['Name']));
		$password = getHash($username,$_POST['ThePassword']);

		$sql = "UPDATE AgentTable SET password = '' WHERE username = '".$username."'";
		mysqli_query($con,$sql);


		$sql = "UPDATE AgentTable SET passwordHash = '".$password."' WHERE username = '".$username."'";
		mysqli_query($con,$sql);

		header("location:/Ingress/Admin");
	}
?>
