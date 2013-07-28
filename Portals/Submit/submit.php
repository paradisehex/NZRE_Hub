<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$URL = strip_tags($_POST['URL']);

		if(IsOfficer($con,$_SESSION['name'])){
			$sql = "SELECT * FROM PortalTable WHERE portalName ='$Name'";
			$result = mysqli_query($con,$sql);
			$count = mysqli_num_rows($result);
			echo $count;
			if($count == 0){
				mysqli_query($con,"insert into PortalTable values('$Name','$Location','$URL');");
				header("location:./");
			}else{
				echo "Portal already added";
			}
		}else{
			header("location:/Ingress");
		}
	}
?>
