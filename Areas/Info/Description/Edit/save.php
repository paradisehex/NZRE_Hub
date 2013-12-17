<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$name = strip_tags(stripslashes($_POST['Name']));;

		if(!OfficerAndLocation($con,$_SESSION['name'],$name)){
			header("location:/Ingress");
		}else{
			$msg = strip_tags(stripslashes($_POST['message']));
			update("LocationTable", array("Description"), array($msg), "name", $name);
			
			header("location:/Ingress/Areas/Info/Description/?Name=".$name);
		}
?>
