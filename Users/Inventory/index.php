<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";
		include "/var/www/Ingress/Tools/AP.php";		
		include "/var/www/Ingress/Users/Inventory/display.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$result=mysqli_query($con,"SELECT * FROM ItemTable WHERE username = \"".$name."\"");
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$row2 = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM AgentTable WHERE username = \"".$name."\""), MYSQL_ASSOC);
		$lvl = $row2['lvl'];

		$Location = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM LocationTable WHERE id = ".$row2['Location']), MYSQL_ASSOC);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
			<div id="Line">
				<?php 
					echo "<strong>".$name."</strong>";
					echoCounter($lvl,$row2['AP']); 
				?>
				<?php echo "<div id=\"Location\"><a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a></div>"; ?>
			</div>
			<br style="line-height:6px;"/>
			<?php
				if(CanVeiwOther($con,$row2['Location'],$lvl)){
					if($row['month']!='Neve'){
						echo "<div id=\"Line\">";
						echo "Last updated on the ".$row['day']." of ".$row['month']." 20".$row['year'];
						echo "</div><br style=\"line-height:6px;\"/>";
					}


					if(IsOfficer($con,$_SESSION['name'])){
						$ChLvl =  "<form action=\"changelvl.php\" method=\"post\">";
							$ChLvl .= "Change players level<br><input class=\"field\" type=\"text\" name=\"Level\" autocomplete=\"off\" placeholder=\"New Level\"><br>";
							$ChLvl .= "<input type=\"hidden\" value=\"".$name."\" name=\"Name\">";
							$ChLvl .= "<input class=\"button\" type=\"submit\" value=\"Update\">";
						$ChLvl .= "</form>";
					}
					echoInv($row,$ChLvl);

				}else{
					echo "Restricted content<br>Insufficient access level";
				}
			?>
	</body>
</html>
