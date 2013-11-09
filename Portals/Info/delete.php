<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/getPortalInfo.php";
		
	if(IsOfficer($con,$_SESSION['name'])){
		
		$Name = strip_tags(stripslashes($_POST['Name']));
		
		deleteFrom("KeyTable", array("portalID"), array(getPortalID($Name)));
		deleteFrom("PortalTable", array("portalName"), array($Name));
			
		header("location:../");
	}else{
		header("location:/Ingress");
	}
?>
