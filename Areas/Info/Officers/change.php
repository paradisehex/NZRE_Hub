<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		if(CaptainAndLocation($con,$_SESSION['name'],$Location)){
			if(0<mysqli_num_rows(selectFrom("OfficerTable", array("username"), array($name)))){
				deleteFrom("OfficerTable", array("username"), array($name));
			}else{
				insert("OfficerTable", array($name,$ID));
			}
			header("location:/Ingress/Areas/Info/Officers/?Name=".$Location);
		}else{
			header("location:/Ingress");
		}
?>
