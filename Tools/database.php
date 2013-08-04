<?php
	
	//Get rid of people who haven't logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
		return;
	}
	include "/var/www/Ingress/.data/DB_PASSWORD.php";
	
	$con = mysqli_connect($HOST,$USER,$PSWD,$DB);
?>
