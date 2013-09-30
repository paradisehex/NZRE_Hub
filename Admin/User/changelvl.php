<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}

		$username=strip_tags(stripslashes($_POST['Name']));
		$lvl=stripslashes($_POST['Level']);
		include "/var/www/Ingress/Tools/database.php";
		$sql = "UPDATE AgentTable SET lvl = '".$lvl."' WHERE username = '".$username."'";
		mysqli_query($con,$sql);
		header("location:./?Name=".$username);
?>
