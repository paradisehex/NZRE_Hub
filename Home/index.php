<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/AP.php";		
		include $_SESSION['path']."/Tools/inventory.php";
		
		$name = $_SESSION['name'];

		$result = selectFrom("ItemTable", array("username"), array($name));
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$row2 = mysqli_fetch_array(selectFrom("AgentTable", array("username"), array($name)), MYSQL_ASSOC);

		$Location = mysqli_fetch_array(selectFrom("LocationTable", array("id"), array($row2['Location'])), MYSQL_ASSOC);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<div style="float: left;position: relative;left: 50%;">
				<div style="float: left;position: relative;left: -50%;">
					<div id="Left" style="margin-right: 50px; margin-left: auto;">
						<?php echoCounter($row2['lvl'],$row2['AP']);?>
					</div>
					<div id="Left" stlye="margin-right: auto;">
						<strong><?php echo $name?></strong><br>
						<?php echo "<div id='Counter' style='font-size: 20px;line-height: 30px;'>".number_format($row2['AP'])." AP</div>";?>
					</div>
				</div>
			</div>
			
			<br>
			<br>
			<br>
			<?php
				
				echo "<div id=\"Line\"><a href=\"/Ingress/Agents/Verification/?Name=".$name."\">View verification</a></div>";
				echo "<div id=\"Line\"><a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a></div>";
				echo "<div id=\"Line\"><a href=\"./Update_Inventory\">Update Inventory</a></div>";
				echo "<div id='Line'><a href='/Ingress/Home/Settings'>Settings</a></div>";
				
				echo "<br>";
				
				echoInv($row);
			?>
	</body>
</html>
