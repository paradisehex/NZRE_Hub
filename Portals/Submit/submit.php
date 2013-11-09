<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$Status = strip_tags(stripslashes($_POST['Status']));
		$Latitude = doubleval(strip_tags($_POST['Latitude']))*1000000;
		$Longitude = doubleval(strip_tags($_POST['Longitude']))*1000000;

		if(IsOfficer($con,$_SESSION['name'])){
			$result = selectFrom("PortalTable", array("portalName"), array($Name));
			$count = mysqli_num_rows($result);
			if($count == 0){
				insertCertainVaules("PortalTable", array("PortalName", "Location", "Status", "Lat", "Lon"), array($Name, $Location, $Status, $Latitude, $Longitude));
				header("location:../");
			}else{
				echo "Portal already added";
			}
		}else{
			header("location:/Ingress");
		}
?>
