<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/AP.php";		
		include $_SESSION['path']."/Agents/display.php";

		$name = strip_tags(stripslashes($_GET['Name']));
		
		if($name == ""){
			$name = $_SESSION['name'];
		}

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
					echo "<form style=\"display: inline;\" action=\"/Ingress/Agents/plusOne.php\" method=\"post\">";
						$Class = isPlused($row['username']) ? "minusOne" : "plusOne";
						if($row['username'] == $_SESSION['name']){$Class = "Hide";}
						echo "<input class=\"".$Class."\" type=\"submit\" value=\"+1\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
					echo "</form>";
					echoCounter($row2['lvl'],$row2['AP']); 
				?>
			</div>
			<div id="Line">
				<div id="Location">
					<?php echo "<a href=\"/Ingress/Agents/Verification/?Name=".$name."\">View verification</a>"; ?>
				<br>
					<?php echo "<a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a>"; ?>
				</div>
			</div>
			<?php
				if(CanVeiwOther($name)){
					if($row['month']!='Neve'){
						echo "<div id=\"Line\">";
						echo "Last updated on the ".$row['day']." of ".$row['month']." 20".$row['year'];
						echo "</div><br style=\"line-height:6px;\"/>";
					}
					
					echoInv($row);

				}else{
					echo "Restricted content<br>Insufficient Verification";
				}
			?>
	</body>
</html>
