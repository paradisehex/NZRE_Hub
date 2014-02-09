<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));

		if(!IsCoordintor($The_OP['ID'], $_SESSION['name'])){
			header("location:/Ingress");
		}else{
			$msg = strip_tags(stripslashes($_POST['message']));
			update("OPSTable", array("Description"), array($msg), "Name", $Name);
			
			header("location:/Ingress/OPS/?Name=".$Name);
		}
?>
