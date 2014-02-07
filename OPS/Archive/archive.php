<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));

		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
		
		if(IsCoordintor($The_OP['ID'], $_SESSION['name'])){
			update("OPSTable", array("Archived"), array(false), "ID", $The_OP['ID']);
			
			header("location:../?Name=".$Name);
		}	
?>
