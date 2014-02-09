<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/alert.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$ID = strip_tags(stripslashes($_POST['ID']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$Status = strip_tags(stripslashes($_POST['Status']));
		$Latitude = doubleval(strip_tags($_POST['Latitude']))*1000000;
		$Longitude = doubleval(strip_tags($_POST['Longitude']))*1000000;
		
		$Private = strip_tags(stripslashes($_POST['Private']));

		if(IsCoordintor($ID, $_SESSION['name'])){
			$TheOP = mysqli_fetch_array(selectFrom("OPSTable", array("ID"), array($ID)));

			$result = selectFrom("PortalTable", array("portalName"), array($Name));
			$count = mysqli_num_rows($result);
			if($count == 0){
				if($Private){
					insertCertainVaules("PortalOPTable", array("PortalName", "Location","Lat", "Lon", "OP_ID", "Private"), array($Name, $Location, $Latitude, $Longitude, $ID, true));
				}else{
					insertCertainVaules("PortalTable", array("PortalName", "Location","Lat", "Lon"), array($Name, $Location, $Latitude, $Longitude));
					insertCertainVaules("PortalOPTable", array("OP_ID","PortalName"), array($ID,$Name));
				}
				header("location:../?Name=".$TheOP['Name']);
			}else{
				errorMsg("Portal already added","./");
			}
		}
?>
