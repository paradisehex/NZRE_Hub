<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";	

		$username=$_SESSION['name'];
		$ap=stripslashes($_POST['AP']);

		update("AgentTable", array("AP"), array($ap), "username", $username);

		header("location:/Ingress/Users");
?>
