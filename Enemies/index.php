<?php
	session_start();
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");return;}
		include "/var/www/Ingress/Tools/database.php";
		
		$sql="SELECT * FROM EnemyTable";
		$result=mysqli_query($con,$sql);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<form action="subEnemy.php" method="post">
				<div id="lineE">
					Submit Enemy Agent
				</div>
				<div id="lineE">
					<input class="field" type="text" name="username" autocomplete="off" placeholder="User Name">
				</div>
				<div id="lineE">
					<input class="field" type="text" name="Level" autocomplete="off" placeholder="Level">
				</div>
				<div id="lineE">
					<input class="button" type="submit" value="Submit" >
				</div>
		</form>
		<br>
			<?php
				$Names = array();
				while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					array_push($Names,$row['username']);
				}
				natcasesort ($Names);

				foreach($Names as $name){
					$sql="SELECT * FROM EnemyTable WHERE username = '".$name."'";
					$result=mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
						echo "<div id=\"LineE\">";
							echo "<div id=\"Left\">";
								echo "<a href=\"/Ingress/Enemies/Info/?Name=".$row['username']."\">".$row['username']."</a>";
							echo "</div><div id=\"Right\">";
								echo "<div id=\"lvl".$row['lvl']."\">".$row['lvl']."</div>";
						echo "</div></div>";
					}
				}
			?>
	</body>
</html>
