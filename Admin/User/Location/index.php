<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
		include $_SESSION['path']."/Tools/database.php";
		 $result = selectFrom("LocationTable", null, null);

		$name = strip_tags(stripslashes($_GET['Name']));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
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
