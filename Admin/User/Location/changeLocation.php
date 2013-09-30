<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
	$locationName = strip_tags(stripslashes($_POST['LocationName']));
	$Name = strip_tags(stripslashes($_POST['Name']));

	include "/var/www/Ingress/Tools/database.php";

	$sql = "SELECT * FROM LocationTable WHERE name = '".$locationName."'";
	$LocationQuery = mysqli_query($con,$sql);
	$Location = mysqli_fetch_array($LocationQuery, MYSQL_ASSOC);

	$sql = "UPDATE AgentTable SET Location = '".$Location['id']."' WHERE username = '".$Name."'";
	mysqli_query($con,$sql);
	header("location:/Ingress/Admin/Location");
?>
