<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		if(IsOfficer($con,$_SESSION['name'])){
			$username=strip_tags(stripslashes($_POST['Name']));
			$lvl=strip_tags(stripslashes($_POST['Level']));
			update("AgentTable", array("lvl"), array($lvl), "username", $username);
			header("location:./?Name=".$username);
		}else{
			header("location:/Ingress");
		}
?>
