<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/AP.php";		
		include $_SESSION['path']."/Home/graphs.php";
		
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
			
			<div id="Line">
				<div id="Location">
					<?php echo "<a href=\"/Ingress/Agents/Verification/?Name=".$name."\">View verification</a>"; ?>
				<br>
					<?php echo "<a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a>"; ?>
				</div>
			</div>
			<?php
				if($row['month']!='Neve'){
					
					$monthNum = 0;
					switch($row['month']){
						case "Jan"	:	$monthNum = 1;		break;
						case "Feb"	:	$monthNum = 2;		break;
						case "Mar"	:	$monthNum = 3;		break;
						case "Apr"	:	$monthNum = 4;		break;
						case "May"	:	$monthNum = 5;		break;
						case "Jun"	:	$monthNum = 6;		break;
						case "Jul"	:	$monthNum = 7;		break;
						case "Aug"	:	$monthNum = 8;		break;
						case "Sep"	:	$monthNum = 9;		break;
						case "Oct"	:	$monthNum = 10;	break;
						case "Nov"	:	$monthNum = 11;	break;
						case "Dec"	:	$monthNum = 12;	break;
					}
					
					$your_date = strtotime("20".$row['year']."/".$monthNum."/".$row['day']);
					$datediff = time() - $your_date;
					$Days = floor($datediff/(60*60*24));
					
					$pural = "'s";
					if($Days == 1){$pural = "";}
					
					echo "<div id=\"Line\">";
					echo "Last updated ".$Days." day".$pural." ago on the ".$row['day']." of ".$row['month']." 20".$row['year'];
					echo "</div><br style=\"line-height:6px;\"/>";
				}
				
				echo "<div id=\"Line\"><a href=\"./Update_Inventory\">Update Inventory</a></div>";
				echo "<div id='Line'><a href='/Ingress/Home/Settings'>Settings</a></div>";
				
				echo "<br>";
				
				echoInv($row);
			?>
	</body>
</html>
