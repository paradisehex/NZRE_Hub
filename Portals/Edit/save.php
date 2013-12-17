<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$ID = strip_tags(stripslashes($_POST['ID']));
		$Name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$Latitude = doubleval(strip_tags($_POST['Latitude']))*1000000;
		$Longitude = doubleval(strip_tags($_POST['Longitude']))*1000000;

		if(IsOfficer($con,$_SESSION['name'])){
			update("PortalTable", array("Location","Lat","Lon","PortalName"), array($Location,$Latitude,$Longitude,$Name), "ID", $ID);
			header("location:../Info/?Name=".$Name);
		}else{
			header("location:/Ingress");
		}
?>
