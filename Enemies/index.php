<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");}
		include "/var/www/Ingress/Tools/database.php";
		$sql="SELECT * FROM EnemyTable";
		$result=mysqli_query($con,$sql);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p><form action="subEnemy.php" method="post">
				Submit Enemy Agent
				<input class="field" type="text" name="username" autocomplete="off" placeholder="User Name">
				<input class="field" type="text" name="Level" autocomplete="off" placeholder="Level">
				<input class="button" type="submit" value="Submit" >
		</form></p>
			<?php
				while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					echo "<div id=\"LineE\">";
						echo "<div id=\"Left\">";
							echo "<a href=\"/Ingress/Enemies/Info/?Name=".$row['username']."\">".$row['username']."</a>";
						echo "</div><div id=\"Right\">";
							echo "<div id=\"lvl".$row['lvl']."\">".$row['lvl']."</div>";
					echo "</div></div>";
				}
			?>
	</body>
</html>
