<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags($_GET['Name']);

		$sql="SELECT * FROM LocationTable WHERE name = \"".$name."\"";

		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$ID = $row['id'];
		
		if($_SESSION['lvl']<5){
			header("location:/Ingress/Enemies/Error");
		}else{
			$sql="SELECT * FROM EnemyTable WHERE Location = ".$row['id'];
			$InLocation=mysqli_query($con,$sql);

			$sql="SELECT * FROM EnemyTable";
			$EveryOne =mysqli_query($con,$sql);
		}
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<br>
		<div id="line">
			<?php
				echo "Select Enemy Agents for ".$name;
				echo "<a href=\"/Ingress/Areas/Info/Enemies/?Name=".$name."\">Back</a>";
			?>
		</div>
		<div id="Line">Remove</div>
			<?php
				echo "<form action=\"change.php\" method=\"post\">";
				while ($row = mysqli_fetch_array($InLocation, MYSQL_ASSOC)) {
					echo "<input class=\"buttonE\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
				}
				echo "<input type=\"hidden\" name=\"ID\" value=\"0\">";
				echo "<input type=\"hidden\" name=\"Location\" value=\"".$name."\">";
				echo "</form>";
			?>
		<div id="Line">Add</div>
			<?php
				echo "<form action=\"change.php\" method=\"post\">";
				while ($row = mysqli_fetch_array($EveryOne, MYSQL_ASSOC)) {
					if($row['Location']!=$ID){
						echo "<input class=\"buttonE\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
					}
				}
				echo "<input type=\"hidden\" name=\"ID\" value=".$ID."><input type=\"hidden\" name=\"Location\" value=\"".$name."\">";
				echo "</form>";
			?>
	</body>
</html>
