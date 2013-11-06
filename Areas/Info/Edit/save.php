<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";

	$name = strip_tags(stripslashes($_POST['Name']));

	if(!OfficerAndLocation($con,$_SESSION['name'],$name)){
		header("location:/Ingress");
	}else{
		$file = $_SESSION['path'].'/.data/Areas/'.$name.'.txt';
		$msg = strip_tags(stripslashes($_POST['message']));
		file_put_contents($file,$msg)==false;
		header("location:/Ingress/Areas/Info/?Name=".$name);
	}
?>
