<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

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
?>
