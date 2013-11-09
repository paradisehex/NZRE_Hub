<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
	$locationName = strip_tags(stripslashes($_POST['LocationName']));
	$Name = strip_tags(stripslashes($_POST['Name']));

	include $_SESSION['path']."/Tools/database.php";

	$LocationQuery = selectFrom("LocationTable", array("name"), array($locationName));
	$Location = mysqli_fetch_array($LocationQuery, MYSQL_ASSOC);

	update("AgentTable", array("Location"), array($Location['id']), "username", $Name);
	header("location:/Ingress/Admin/Location");
?>
