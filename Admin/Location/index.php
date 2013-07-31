<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
	include "/var/www/Ingress/Tools/database.php";
	$sql="SELECT * FROM LocationTable";
	$result=mysqli_query($con,$sql);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<?php
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<div id=\"line\">";
				echo "<a href=\"/Ingress/Admin/Location/SelectAdmin/?Name=".$row['name']."\"><div id=\"left\">".$row['name']."</div><div id=\"right\">".$row['admin']."</div></a>";
				echo "</div>";
			}
		?>
	</body>
</html>
