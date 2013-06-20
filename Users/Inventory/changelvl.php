<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		if($IsOfficer($con,$_SESSION['name'])){
			$username=strip_tags(stripslashes($_POST['Name']));
			$lvl=strip_tags(stripslashes($_POST['Level']));
			$sql = "UPDATE AgentTable SET lvl = '".$lvl."' WHERE username = '".$username."'";
			mysqli_query($con,$sql);
			header("location:./?Name=".$username);
		}else{
			header("location:/Ingress");
		}
	}
?>
