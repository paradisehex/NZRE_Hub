<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		if($_SESSION['lvl']>=5){
			$sql="UPDATE EnemyTable set Location =".$ID."  WHERE username = '".$name."'";
			mysqli_query($con,$sql);
			header("location:/Ingress/Areas/Info/Enemies/Select/?Name=".$Location);
		}else{
			header("location:/Ingress");
		}
	}
?>
