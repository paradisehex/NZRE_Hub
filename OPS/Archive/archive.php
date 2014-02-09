<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));

		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
		
		
		if(IsCoordintor($The_OP['ID'], $_SESSION['name'])){
			$Portals = selectFrom("PortalOPTable", array("OP_ID"), array($TheOP['ID']));
			
			while ($Portal = mysqli_fetch_array($Portals, MYSQL_ASSOC)) {
				$result = selectFrom("PortalTable", array("portalName"), array($Name));
				$count = mysqli_num_rows($result);
				
				if($count == 0){
					insertCertainVaules("PortalTable", array("PortalName", "Location","Lat", "Lon"), array($Portal['PortalName'], $Portal['Location'], $Portal['Lat'], $Portal['Lon']));
				}	
			}
			
			update("PortalOPTable", array("Private"), array(false), "OP_ID", $The_OP['ID']);
			update("OPSTable", array("Archived"), array(false), "ID", $The_OP['ID']);
			
			header("location:../?Name=".$Name);
		}	
?>
