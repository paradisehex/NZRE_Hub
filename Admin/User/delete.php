<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}


		$username=strip_tags(stripslashes($_POST['Name']));
		include $_SESSION['path']."/Tools/database.php";

		//Delete them
			deleteFrom("AgentTable", array("username"), array($username));
			deleteFrom("ItemTable", array("username"), array($username));
			deleteFrom("OfficerTable", array("username"), array($username));
			deleteFrom("KeyTable", array("username"), array($username));


		//Go back to tools
			header("location:/Ingress/Admin");
?>
