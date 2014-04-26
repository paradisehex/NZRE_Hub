<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/AP.php";		
		include $_SESSION['path']."/Tools/inventory.php";

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
					echoCounter($row2['lvl'],$row2['AP']); 
				?>
			</div>
			<div id="Line">
					<?php
						echo "<a href=\"/Ingress/Agents/Verification/?Name=".$name."\" style=\"width:59%;\">View verification</a> ";
						echo "<form style=\"display: inline-block; height: 32; margin: 0px; padding: 0px; width: 10%;\" action=\"/Ingress/Agents/plusOne.php\" method=\"post\">";
							$Class = isPlused($row['username']) ? "minusOne" : "plusOne";
							if($row['username'] == $_SESSION['name']){$Class = "Hide";}
							echo "<input class=\"".$Class."\" type=\"submit\" value=\"+1\" style='width:100%; height: 100%; margin: 0; padding: 0;' display: block;><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
						echo "</form>";
					?></div>
			<?php
					

				echo "<div id=\"Line\"><a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a></div>";
				if(CanVeiwOther($name)){
					
					echoInv($row);

				}else{
					echo "Restricted content<br>Insufficient Verification";
				}
			?>
	</body>
</html>
