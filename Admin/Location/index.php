<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
	include $_SESSION['path']."/Tools/database.php";
	$result=selectFrom("LocationTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<?php
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<div id=\"line\">";
				echo "<a href=\"/Ingress/Admin/Location/SelectAdmin/?Name=".$row['name']."\"><div id=\"left\">".$row['name']."</div><div id=\"right\">".$row['admin']."</div></a>";
				echo "</div>";
			}
		?>
	</body>
</html>
