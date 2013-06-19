<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");}else{
			include "/var/www/Ingress/Tools/database.php";

			$name = strip_tags(stripslashes($_GET['Name']));

			$sql="SELECT * FROM LocationTable WHERE name='".$name."'";
			$row = mysqli_fetch_array(mysqli_query($con,$sql));
		}
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

			$sql="SELECT * FROM EnemyTable WHERE Location=".$row['id'];
			$result = mysqli_query($con,$sql);

			$isAgents = false;

			while ($Agents = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<div id=\"lineE\">";
				echo "<a href=\"/Ingress/Enemies/Info/?Name=".$Agents['username']."\">";
				echo "<div id=\"Left\"><div id=\"lvl".$Agents['lvl']."\" style=\"padding-left:2px;\">".$Agents['lvl']."</div></div>".$Agents['username']."</a>";
				echo "</div>";
				$isAgents = true;
			}
			if(!$isAgents){
				echo "No enemy agents in is area";
			}
			
		?>
	</body>
</html>
