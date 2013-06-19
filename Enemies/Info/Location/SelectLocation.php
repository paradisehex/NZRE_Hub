<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");}
		$locationName = strip_tags(stripslashes($_POST['Location']));
		$Name = strip_tags(stripslashes($_POST['Name']));

		include "/var/www/Ingress/Tools/database.php";

		$sql="SELECT * FROM LocationTable WHERE name = '".$locationName."'";
		$row = mysqli_fetch_array(mysqli_query($con,$sql), MYSQL_ASSOC);

		$sql = "UPDATE EnemyTable SET Location = '".$row['id']."' WHERE username = '".$Name."'";
		mysqli_query($con,$sql);
		header("location:/Ingress/Enemies/Info/?Name=".$Name);
	}
?>
