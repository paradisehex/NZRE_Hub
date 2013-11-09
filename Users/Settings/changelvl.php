<?php
	session_start();
	if($_SESSION['lvl']>=8){
		$username=strip_tags(stripslashes($_POST['Name']));
		$lvl=strip_tags(stripslashes($_POST['Level']));
		include $_SESSION['path']."/Tools/database.php";

		update("AgentTable", array("lvl"), array($lvl), "username", $username);

		$_SESSION['lvl'] = $lvl;

		header("location:./");
	}else{
		header("location:/Ingress");
	}
?>
