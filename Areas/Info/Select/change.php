<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		if(IsOfficer($con,$_SESSION['name'])){
			$sql="UPDATE AgentTable set Location =".$ID."  WHERE username = '".$name."'";
			mysqli_query($con,$sql);
			header("location:/Ingress/Areas/Info/Select/?Name=".$Location);
		}else{
			header("location:/Ingress");
		}
	}
?>
