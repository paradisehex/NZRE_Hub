<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/getPortalInfo.php";
		
	if(IsOfficer($con,$_SESSION['name'])){
		
		$Name = strip_tags(stripslashes($_POST['Name']));
		
		mysqli_query($con,"delete from PortalTable WHERE portalName = '".$Name."'");
		mysqli_query($con,"delete from KeyTable WHERE portalID = '".getPortalID($Name)."'");
			
		header("location:../");
	}else{
		header("location:/Ingress");
	}
?>
