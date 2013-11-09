<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}

		$username=strip_tags(stripslashes($_POST['Name']));
		$lvl=stripslashes($_POST['Level']);
		
		include $_SESSION['path']."/Tools/database.php";
		update("AgentTable", array("lvl"), array($lvl), "username", $username);
		
		header("location:./?Name=".$username);
?>
