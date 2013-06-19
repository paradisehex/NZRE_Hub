<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		$sql="SELECT * FROM EnemyTable";
		$result=mysqli_query($con,$sql);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?><br>
		Restricted Access<br>
		You must be at least level 5 to use the Enemy Intel
	</body>
</html>
