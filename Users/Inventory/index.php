<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/AP.php";		
		include $_SESSION['path']."/Users/Inventory/display.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$result = selectFrom("ItemTable", array("username"), array($name));
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$row2 = mysqli_fetch_array(selectFrom("AgentTable", array("username"), array($name)), MYSQL_ASSOC);

		$Location = mysqli_fetch_array(selectFrom("LocationTable", array("id"), array($row2['Location'])), MYSQL_ASSOC);
				
		function isPlused($Name){
			$Count = mysqli_num_rows(selectFrom("VerifyTable", array("Truster", "Trustee"), array($_SESSION['name'], $Name)));
			return ($Count == 1);
		}
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<div id="Line">
				<?php 
					echo "<strong>".$name."</strong>";
					echo "<form style=\"display: inline;\" action=\"/Ingress/Users/Inventory/plusOne.php\" method=\"post\">";
						$Class = isPlused($row['username']) ? "minusOne" : "plusOne";
						if($row['username'] == $_SESSION['name']){$Class = "Hide";}
						echo "<input class=\"".$Class."\" type=\"submit\" value=\"+1\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
					echo "</form>";
					echoCounter($row2['lvl'],$row2['AP']); 
				?>
			</div>
			<div id="Line">
				<?php echo "<div id=\"Location\"><a href=\"/Ingress/Users/Inventory/Verification/?Name=".$name."\">View verification</a></div>"; ?>
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
