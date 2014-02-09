<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));

		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
		echo $Name;
		
		if(IsCoordintor($The_OP['ID'], $_SESSION['name'])){
			deleteFrom("OPSTable", array("Name"), array($Name));
			deleteFrom("CoordinatorTable", array("ID"), array($The_OP['ID']));
			deleteFrom("ParticipantTable", array("ID"), array($The_OP['ID']));
			deleteFrom("CommentsTable", array("ID"), array($The_OP['ID']));
			deleteFrom("PortalOPTable", array("OP_ID"), array($The_OP['ID']));
			
			header("location:../");
		}	
?>
