<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/AP.php";
		include $_SESSION['path']."/Users/Inventory/display.php";
		
		$result= selectFrom("ItemTable", array("username"), array($_SESSION['name']));
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$row2 = mysqli_fetch_array(selectFrom("AgentTable", array("username"), array($_SESSION['name'])), MYSQL_ASSOC);
		$lvl = $row2['lvl'];
		
		$Location = mysqli_fetch_array(selectFrom("LocationTable", array("id"), array($row2['Location'])), MYSQL_ASSOC);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
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
