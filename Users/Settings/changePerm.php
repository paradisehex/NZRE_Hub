<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";
	
		$Degree = strip_tags(stripslashes($_POST['Degree']));

		update("AgentTable", array("ViewDegree"), array($Degree), "username", $_SESSION['name']);

		header("location:./");
?>
