<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");}
		$username=strip_tags(stripslashes($_POST['username']));
		include "/var/www/Ingress/Tools/database.php";

		$sql = "UPDATE EnemyTable SET day=".date('d',time()).",month='".date('M',time())."',year=".date('y',time())." WHERE username = '".$username."'";
		mysqli_query($con,$sql);

		$file = '/var/www/Ingress/.data/Enemies/'.$_POST['username'].'.txt';
		$msg = strip_tags(stripslashes($_POST['message']));
		file_put_contents($file,$msg)==false;
		header("location:/Ingress/Enemies/Info/?Name=".$_POST['username']);
	}
?>
