<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		if(CaptainAndLocation($con,$_SESSION['name'],$Location)){
			$OfficerQuery = "SELECT * FROM OfficerTable WHERE username = '".$name."'";
			if(0<mysqli_num_rows(mysqli_query($con,$OfficerQuery))){
				mysqli_query($con,"delete from OfficerTable where username = '".$name."'");
			}else{
				mysqli_query($con,"insert into OfficerTable values('".$name."','".$ID."')");
			}
			header("location:/Ingress/Areas/Info/Officers/?Name=".$Location);
		}else{
			header("location:/Ingress");
		}
?>
