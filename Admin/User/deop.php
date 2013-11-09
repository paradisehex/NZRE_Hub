<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
		$username=strip_tags(stripslashes($_POST['Name']));
		include $_SESSION['path']."/Tools/database.php";
		update("AgentTable", array("Admin"), array(0), "username", $username);
		header("location:./?Name=".$username);
?>
