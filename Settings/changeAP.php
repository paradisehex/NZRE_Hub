<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/alert.php";	

		$username = $_SESSION['name'];
		$ap = stripslashes($_POST['AP']);

		update("AgentTable", array("AP"), array($ap), "username", $username);

		notifyMsg("AP changed to ".$ap, "./");
?>
