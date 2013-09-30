<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$name = strip_tags($_GET['Name']);

		$sql="SELECT * FROM LocationTable WHERE name = \"".$name."\"";

		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$ID = $row['id'];
		
		if(!IsOfficer($con,$_SESSION['name'])){
			header("location:/Ingress");
		}else{
			$sql="SELECT * FROM AgentTable WHERE Location = ".$row['id'];
			$InLocation=mysqli_query($con,$sql);

			$sql="SELECT * FROM AgentTable";
			$EveryOne =mysqli_query($con,$sql);
		}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<br>
		<div id="line">
			<?php
				echo "<a href=\"/Ingress/Areas/Info/?Name=".$name."\">Back</a>";
			?>
		</div>
		<div id="Line">Remove</div>
			<?php
				echo "<form action=\"change.php\" method=\"post\">";
				while ($row = mysqli_fetch_array($InLocation, MYSQL_ASSOC)) {
					echo "<input class=\"button\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
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
						echo "<input class=\"button\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
					}
				}
				echo "<input type=\"hidden\" name=\"ID\" value=".$ID."><input type=\"hidden\" name=\"Location\" value=\"".$name."\">";
				echo "</form>";
			?>
	</body>
</html>
