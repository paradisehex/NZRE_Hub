<?php
	session_start();
	
	include "/var/www/Ingress/Tools/database.php";
	include "/var/www/Ingress/Tools/permission.php";
	include "/var/www/Ingress/Tools/getPortalInfo.php";
		
	if(IsOfficer($con,$_SESSION['name'])){
		
		$Name = strip_tags(stripslashes($_POST['Name']));
		
		mysqli_query($con,"delete from PortalTable WHERE portalName = '".$Name."'");
		mysqli_query($con,"delete from KeyTable WHERE portalName = '".getPortalID($Name)."'");
			
		header("location:../");
	}else{
		header("location:/Ingress");
	}
?>
