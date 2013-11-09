<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
	$locationName = strip_tags(stripslashes($_POST['LocationName']));
	$Name = strip_tags(stripslashes($_POST['User']));

	include $_SESSION['path']."/Tools/database.php";

	update("LocationTable", array("admin"), array($Name), "name", $locationName);
	
	header("location:/Ingress/Admin/Location");
?>
