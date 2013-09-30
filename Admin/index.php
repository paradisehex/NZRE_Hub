<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
		include "/var/www/Ingress/Tools/database.php";
		$sql="SELECT * FROM AgentTable";
		$result=mysqli_query($con,$sql);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<div id="line"><a href="Register">Register User</a></div>
		<div id="line"><a href="/Ingress/Admin/Location">Location</a></div>
		<div id="line">Users:</div>
		<?php
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<div id=\"line\"><a href=\"/Ingress/Admin/User/?Name=".$row['username']."\">".$row['username']." Level ".$row['lvl']."</a></div>";
			}
		?>
	</body>
</html>
