<?php
	session_start();
	
		include "/var/www/Ingress/Tools/database.php";
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");return;}
		
		$username=strip_tags(stripslashes($_POST['username']));
		$lvl=strip_tags(stripslashes($_POST['Level']));

		$sql = "UPDATE EnemyTable SET lvl = '".$lvl."',day=".date('d',time()).",month='".date('M',time())."',year=".date('y',time())." WHERE username = '".$username."'";
		mysqli_query($con,$sql);
		header("location:/Ingress/Enemies/Info/?Name=".$_POST['username']);
?>
