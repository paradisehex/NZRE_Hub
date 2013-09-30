<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags($_GET['Name']);

		$sql="SELECT * FROM LocationTable WHERE name = \"".$name."\"";

		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$ID = $row['id'];

		$sql="SELECT * FROM AgentTable WHERE Location = ".$row['id'];
		$InLocation=mysqli_query($con,$sql);

		$sql="SELECT * FROM AgentTable";
		$EveryOne =mysqli_query($con,$sql);
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
		<div id="Line">Select</div>
			<?php
				echo "<form action=\"change.php\" method=\"post\">";
				$OfficerQuery = "SELECT * FROM OfficerTable WHERE username = '";
				while ($row = mysqli_fetch_array($InLocation, MYSQL_ASSOC)) {
					if(0<mysqli_num_rows(mysqli_query($con,$OfficerQuery.$row['username']."'"))){	
						echo "<input class=\"buttonOfficer\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
					}else{
						echo "<input class=\"button\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
					}
				}
				echo "<input type=\"hidden\" name=\"ID\" value=\"".$ID."\">";
				echo "<input type=\"hidden\" name=\"Location\" value=\"".$name."\">";
				echo "</form>";
			?>
	</body>
</html>
