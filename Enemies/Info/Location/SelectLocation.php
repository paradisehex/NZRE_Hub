<?php
	session_start();

		include "/var/www/Ingress/Tools/database.php";
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");return;}
		
		$locationName = strip_tags(stripslashes($_POST['Location']));
		$Name = strip_tags(stripslashes($_POST['Name']));

		$sql="SELECT * FROM LocationTable WHERE name = '".$locationName."'";
		$row = mysqli_fetch_array(mysqli_query($con,$sql), MYSQL_ASSOC);

		$sql = "UPDATE EnemyTable SET Location = '".$row['id']."' WHERE username = '".$Name."'";
		mysqli_query($con,$sql);
		header("location:/Ingress/Enemies/Info/?Name=".$Name);
?>
