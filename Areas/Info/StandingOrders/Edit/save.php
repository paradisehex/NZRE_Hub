<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$name = strip_tags(stripslashes($_POST['Name']));;

		if(!OfficerAndLocation($con,$_SESSION['name'],$name)){
			header("location:/Ingress");
		}else{
			$file = '/var/www/Ingress/.data/Areas/StandingOrders/'.$name.'.txt';
			$msg = strip_tags(stripslashes($_POST['message']));
			file_put_contents($file,$msg)==false;
			header("location:/Ingress/Areas/Info/StandingOrders/?Name=".$name);
		}
	}
?>
