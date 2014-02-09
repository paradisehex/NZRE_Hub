<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/alert.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		if(IsCoordintor($ID, $_SESSION['name'])){
		
			$TheOP = mysqli_fetch_array(selectFrom("OPSTable", array("ID"), array($ID)));
		
			if(0 != mysqli_num_rows(selectFrom("PortalOPTable", array("PortalName","OP_ID"), array($Name,$ID)))){
				$The_Portal = mysqli_fetch_array(selectFrom("PortalOPTable", array("PortalName","OP_ID"), array($Name)));
			
				if((0 == mysqli_num_rows(selectFrom("PortalTable", array("PortalName"), array($Name)))) && ($The_Portal['lat'] != "")){
					//Needs to be added to public	
					insertCertainVaules(
						"PortalTable",
						array("PortalName", "Location","Lat", "Lon"),
						array($The_Portal['PortalName'], $The_Portal['Location'], $The_Portal['lat'], $The_Portal['lon'])
					);
				}
				
				deleteFrom("PortalOPTable", array("PortalName","OP_ID"), array($Name,$ID));
					
			}else{
				insertCertainVaules("PortalOPTable", array("OP_ID","PortalName"), array($ID,$Name));
			}
			header("location:./?Name=".$TheOP['Name']);
		}else{
			header("location:/Ingress");
		}
?>
