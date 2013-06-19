<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		$sql="SELECT * FROM LocationTable WHERE name = \"".$name."\"";
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		if($row['admin']!=$_SESSION['name']){
			header("location:/Ingress");
		}else{
			$file = '/var/www/Ingress/Data/Areas/'.$name.'.txt';
			$msg = strip_tags(stripslashes($_POST['message']));
			file_put_contents($file,$msg)==false;
			header("location:/Ingress/Areas/Info/?Name=".$name);
		}
	}
?>
