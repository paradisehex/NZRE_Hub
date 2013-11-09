<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/password.php";

		$username = strip_tags(stripslashes($_POST['Name']));
		$password = getHash($username,$_POST['ThePassword']);

		update("AgentTable", array("passwordHash"), array($password), "username", $username);

		header("location:/Ingress/Admin");
?>
