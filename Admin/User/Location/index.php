<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		$sql="SELECT * FROM LocationTable";
		$result=mysqli_query($con,$sql);

		$name = strip_tags(stripslashes($_GET['Name']));
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<?php
			echo "Select a new location for <b>".$name."</b>";
			echo "<form action=\"changeLocation.php\" method=\"post\">";
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<input class=\"button\" type=\"submit\" name=\"LocationName\" value=\"".$row['name']."\">";
			}
			echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\">";
			echo "</form>";
		?>
	</body>
</html>
