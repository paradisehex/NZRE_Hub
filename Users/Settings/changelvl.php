<?php
	session_start();
		$username=strip_tags(stripslashes($_POST['Name']));
		$lvl=strip_tags(stripslashes($_POST['Level']));
		
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/alert.php";

		update("AgentTable", array("lvl"), array($lvl), "username", $_SESSION['name']);

		$_SESSION['lvl'] = $lvl;

		notifyMsg("Level changed to ".$lvl, "./");
?>
