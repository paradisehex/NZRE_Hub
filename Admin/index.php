<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
		include $_SESSION['path']."/Tools/database.php";
		$result= selectFrom("AgentTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<div id="line"><a href="Log">Log</a></div>
		<div id="line"><a href="Register">Register User</a></div>
		<div id="line"><a href="Location">Location</a></div>
		<div id="line">Users:</div>
		<?php
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<div id=\"line\"><a href=\"/Ingress/Admin/User/?Name=".$row['username']."\">".$row['username']." Level ".$row['lvl']."</a></div>";
			}
		?>
	</body>
</html>
