<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";
		include "/var/www/Ingress/Tools/userList.php";

		$sql="SELECT * FROM AgentTable";
		$result=mysqli_query($con,$sql);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<?php
				if(IsOfficer($con,$_SESSION['name'])){
					echo "<div id=\"line\"><a href=\"Register\">Register Agent</a></div><br>";
				}

				echoAgentsRanking($result,$con);
			?>
		</p>
	</body>
</html>
