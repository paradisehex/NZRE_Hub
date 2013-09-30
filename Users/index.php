<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/AP.php";
		include "/var/www/Ingress/Users/Inventory/display.php";

		$sql="SELECT * FROM ItemTable WHERE username = \"".$_SESSION['name']."\"";
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$row2 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM AgentTable WHERE username = \"".$_SESSION['name']."\""), MYSQL_ASSOC);
		$lvl = $row2['lvl'];

		$Location = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM LocationTable WHERE id = ".$row2['Location']), MYSQL_ASSOC);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
			<div id="Line">
				<?php echoCounter($lvl,$row2['AP']); ?>
				<?php echo "<div id=\"Location\"><a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a></div>"; ?>
			</div>
			<br style="line-height:6px;"/>
			<?php
				if($row['month']!='Neve'){
					echo "<div id=\"Line\">";
					echo "Last updated on the ".$row['day']." of ".$row['month']." 20".$row['year'];
					echo "</div>";
				}
			?>
			<br style="line-height:6px;"/>
			<?php
				echoInv($row,"<div id=\"Line\"><a href=\"/Ingress/Users/Update_Inventory\">Update Inventory</a></div><br>");
			?>
	</body>
</html>
