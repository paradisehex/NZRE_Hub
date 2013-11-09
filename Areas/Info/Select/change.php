<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		if(IsOfficer($con,$_SESSION['name'])){
			update("AgentTable", array("Location"), array($ID), "username", $name);
			header("location:/Ingress/Areas/Info/Select/?Name=".$Location);
		}else{
			header("location:/Ingress");
		}
?>
