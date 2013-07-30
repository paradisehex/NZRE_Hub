<?php
	
	//Get rid of people who haven't logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
		return;
	}
	
	$HOST = "localhost";
	$USER = "resistance";
	$PSWD = "oothjssr";
	$DB = "Ingress";
	
	$con = mysqli_connect($HOST,$USER,$PSWD,$DB);
?>
