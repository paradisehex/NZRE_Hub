<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/getPortalInfo.php";
		
	if(IsOfficer($con,$_SESSION['name'])){
		
		$ID = strip_tags(stripslashes($_POST['ID']));
		
		deleteFrom("PortalTagTable", array("taglID"), array($ID));
		deleteFrom("TagTable", array("ID"), array($ID));
			
		header("location:../");
	}else{
		header("location:/Ingress");
	}
?>
