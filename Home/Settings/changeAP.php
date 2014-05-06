<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/AP.php";
	include $_SESSION['path']."/Tools/alert.php";	
	
	$ap = stripslashes($_POST['AP']);
	
	changeAP($ap);
	
	notifyMsg("AP changed to ".$ap, "./");
?>
