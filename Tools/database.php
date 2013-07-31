<?php
	
	//Get rid of people who haven't logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
		return;
	}
	
	$HOST = "localhost";
	$USER = "resistance";
	$PSWD = "dont tell robo the password";
	$DB = "Ingress";
	
	$con = mysqli_connect($HOST,$USER,$PSWD,$DB);
?>
