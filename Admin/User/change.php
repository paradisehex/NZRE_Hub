<?php
	session_start();
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}else{
		$username=strip_tags(stripslashes($_POST['Name']));
		$password=md5($_POST['ThePassword']);
		include "/var/www/Ingress/Tools/database.php";
		$sql = "UPDATE AgentTable SET password = '".$password."' WHERE username = '".$username."'";
		mysqli_query($con,$sql);
		header("location:/Ingress/Admin");
	}
?>
