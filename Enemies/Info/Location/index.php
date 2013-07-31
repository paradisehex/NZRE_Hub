<?php
	session_start();
	
		include "/var/www/Ingress/Tools/database.php";
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");return;}
		
		$name = strip_tags(stripslashes($_GET['Name']));
		$sql="SELECT * FROM EnemyTable WHERE username = \"".$name."\"";
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$sql="SELECT * FROM LocationTable";
		$resultL=mysqli_query($con,$sql);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<br>
		<div id="LineE"><?php echo "<div id=\"lvl".$row['lvl']."\">"."Select location for ".$name." Level ".$row['lvl']."</div>"; ?></div>
		<?php
			echo "<form action=\"SelectLocation.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\" >";
			while ($rowL = mysqli_fetch_array($resultL, MYSQL_ASSOC)) {
				echo "<input class=\"buttone\" type=\"submit\" name=\"Location\" value=\"".$rowL['name']."\" >";
			}
			echo "</form>";
		?>
	</body>
</html>
