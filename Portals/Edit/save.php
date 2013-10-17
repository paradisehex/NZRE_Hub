<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$ID = strip_tags(stripslashes($_POST['ID']));
		$Name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$Status = strip_tags(stripslashes($_POST['Status']));
		$Latitude = doubleval(strip_tags($_POST['Latitude']))*1000000;
		$Longitude = doubleval(strip_tags($_POST['Longitude']))*1000000;

		if(IsOfficer($con,$_SESSION['name'])){
			$sql = "UPDATE PortalTable SET Location = '".$Location."' , Status = '".$Status."' , Lat = '".$Latitude."' , Lon = '".$Longitude."' , PortalName = '".$Name."' WHERE ID = '".$ID."'";
			mysqli_query($con, $sql);
			header("location:../Info/?Name=".$Name);
		}else{
			header("location:/Ingress");
		}
?>
