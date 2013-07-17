<?php
ob_start();
session_start();
if(!$_SESSION['name']){
	header("location:/Ingress");
}else{
	if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");}else{
		// Connect to server and select databse.
		include "/var/www/Ingress/Tools/database.php";

		// Define $myusername and $mypassword  and protect againest MYSQL injection
		$myusername=strip_tags(stripslashes($_POST['username']));
		$level=stripslashes($_POST['Level']);

		//See if user name is taken
		$sql="SELECT * FROM EnemyTable WHERE username='$myusername'";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);

		// If count equals 0 the username isn't taken
		if($count==0){
				//Add password and user to data base
				$sql = "insert into EnemyTable values('$myusername',$level,".date('d',time()).",'".date('M',time())."',".date('y',time()).",0)";
				mysqli_query($con,$sql);
				//Go to tools page
				header("location:/Ingress/Enemies/Info/?Name=".$myusername);
		}
		else {
			echo "Enemy already added";
		}
	}
}
?>
