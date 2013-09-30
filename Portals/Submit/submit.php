<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$Latitude = doubleval(strip_tags($_POST['Latitude']))*1000000;
		$Longitude = doubleval(strip_tags($_POST['Longitude']))*1000000;

		if(IsOfficer($con,$_SESSION['name'])){
			$sql = "SELECT * FROM PortalTable WHERE portalName ='$Name'";
			$result = mysqli_query($con,$sql);
			$count = mysqli_num_rows($result);
			echo $count;
			if($count == 0){
				mysqli_query($con,"insert into PortalTable values('$Name','$Location','$Latitude','$Longitude');");
				header("location:../");
			}else{
				echo "Portal already added";
			}
		}else{
			header("location:/Ingress");
		}
?>
