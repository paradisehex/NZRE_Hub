<?php
	session_start();
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");}else{
			include "/var/www/Ingress/Tools/database.php";

			$name = strip_tags(stripslashes($_GET['Name']));

			$sql="SELECT * FROM LocationTable WHERE name='".$name."'";
			$row = mysqli_fetch_array(mysqli_query($con,$sql));
		}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\"><b>".$name."</b> Enemy Agents</div>";
			echo "<div id=\"line\"><a href=\"/Ingress/Areas/Info/?Name=".$name."\">Back</a></div>";

			if($_SESSION['lvl']>=5){
				echo "<div id=\"line\"><a href=\"/Ingress/Areas/Info/Enemies/Select/?Name=".$name."\">Add or Remove</a></div>";
			}

			

			$isAgents = false;

			$sql="SELECT * FROM EnemyTable WHERE Location=".$row['id'];
			$result = mysqli_query($con,$sql);

			$Names = array();
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				array_push($Names,$row['username']);
				$isAgents = true;
			}
			natcasesort($Names);

			foreach($Names as $name){
				$sql="SELECT * FROM EnemyTable WHERE username = '".$name."'";
				$result=mysqli_query($con,$sql);
				while ($Agents = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					echo "<div id=\"LineE\">";
						echo "<div id=\"Left\">";
							echo "<a href=\"/Ingress/Enemies/Info/?Name=".$Agents['username']."\">".$Agents['username']."</a>";
						echo "</div><div id=\"Right\">";
							echo "<div id=\"lvl".$Agents['lvl']."\">".$Agents['lvl']."</div>";
					echo "</div></div>";
				}
			}
			if(!$isAgents){
				echo "No enemy agents in is area";
			}
			
		?>
	</body>
</html>
