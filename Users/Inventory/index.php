<?php
	session_start();
	
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";
		include "/var/www/Ingress/Tools/AP.php";		
		include "/var/www/Ingress/Users/Inventory/display.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$result=mysqli_query($con,"SELECT * FROM ItemTable WHERE username = \"".$name."\"");
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$row2 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM AgentTable WHERE username = \"".$name."\""), MYSQL_ASSOC);

		$Location = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM LocationTable WHERE id = ".$row2['Location']), MYSQL_ASSOC);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
			<div id="Line">
				<?php 
					echo "<strong>".$name."</strong>";
					echoCounter($row2['lvl'],$row2['AP']); 
				?>
			</div>
			<div id="Line">
				<?php echo "<div id=\"Location\"><a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a></div>"; ?>
			</div>
			<br style="line-height:6px;"/>
			<?php
				if(CanVeiwOther($con,$name)){
					if($row['month']!='Neve'){
						echo "<div id=\"Line\">";
						echo "Last updated on the ".$row['day']." of ".$row['month']." 20".$row['year'];
						echo "</div><br style=\"line-height:6px;\"/>";
					}


					$ChLvl = "";//TODO This Needs fixing I left it here in a rush
					echoInv($row,$ChLvl);

				}else{
					echo "Restricted content<br>Insufficient access level";
				}



				if(IsOfficer($con,$_SESSION['name'])){
					$ChLvl =  "<br><br><form action=\"changelvl.php\" method=\"post\">";
						$ChLvl .= "Change players level<br><input class=\"field\" type=\"text\" name=\"Level\" autocomplete=\"off\" placeholder=\"New Level\"><br>";
						$ChLvl .= "<input type=\"hidden\" value=\"".$name."\" name=\"Name\">";
						$ChLvl .= "<input class=\"button\" type=\"submit\" value=\"Update\">";
					$ChLvl .= "</form>";
					echo $ChLvl;
				}
			?>
	</body>
</html>
