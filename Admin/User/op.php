<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
		$username=strip_tags(stripslashes($_POST['Name']));
		include "/var/www/Ingress/Tools/database.php";
		$sql = "UPDATE AgentTable SET Admin = '1' WHERE username = '".$username."'";
		mysqli_query($con,$sql);
		header("location:/Ingress/Admin/User/?Name=".$username);
?>
