<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$result = selectFrom("ItemTable", array("username"), array($_SESSION['name']));
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		
		include $_SESSION['path']."/Tools/getColour.php";
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p><form name="LoginForm" action="updateinv.php" method="post" class="inventory">
				Update Inventory<br><br>
				<?php

				function echoCell($Num, $ID, $Lvl, $Tab){
					$colour = getLvlColour($Lvl); 
					echo "<td style=\"border: 1px solid #59FBEA;\">";
					if($Num!=0){
						echo "<input class=\"Cell\" type=\"text\" name=\"".$ID."\" autocomplete=\"off\" style=\"color:".$colour.";\" value=\"".$Num."\" tabindex=".$Tab.">";
					}else{
						echo "<input class=\"Cell\" type=\"text\" name=\"".$ID."\" autocomplete=\"off\" style=\"color:".$colour.";\" tabindex=".$Tab.">";
					}
					echo "</td>";
				}

				function echoCellMod($Num, $ID, $Lvl, $Tab){
					$colour = getRarityColour($Lvl); 
					echo "<td style=\"border: 1px solid #59FBEA;\">";
					if($Num!=0){
						echo "<input class=\"Cell\" type=\"text\" name=\"".$ID."\" autocomplete=\"off\" style=\"color:".$colour.";\" value=\"".$Num."\" tabindex=".$Tab.">";
					}else{
						echo "<input class=\"Cell\" type=\"text\" name=\"".$ID."\" autocomplete=\"off\" style=\"color:".$colour.";\" tabindex=".$Tab.">";
					}
					echo "</td>";
				}

				//AP
				
				?>
				<table>
					<tr>
						<td></td>
						<td style="text-align: center;">Res</td>
						<td style="text-align: center;">XMP</td>
						<td style="text-align: center;">Ultra</td>
						<td style="text-align: center;">Cube</td>
					</tr>
					<?php
						for ($i = 1; $i <= 8; $i++) {
							echo "<tr>";
								echo "<td><div id=\"lvl".$i."\">L".$i."</div></td>";
								echoCell($row["R".$i], "R".$i, $i, $i);
								echoCell($row["X".$i], "X".$i, $i, $i+8);
								echoCell($row['U'.$i] , 'U'.$i, $i, $i+16);
								echoCell($row["P".$i], "P".$i, $i, $i+40);
								//echoCell($row['M'.$i] , 'M'.$i, $i);
							echo "</tr>";
						}
						
						$Tab = 8*3;
						//ADA
							echo "<tr><td>ADA</td>";
							echo "<td></td>";
							echo "<td></td>";
							echoCellMod($row["VA"], "VA", 3, ++$Tab);
							echo "</tr>";
						//Jarvis
							echo "<tr><td>Jarvis</td>";
							echo "<td></td>";
							echo "<td></td>";
							echoCellMod($row["VJ"], "VJ", 3, ++$Tab);
							echo "</tr>";
						//Shields
							echo "<tr><td>Shields</td>";
							echoCellMod($row["S1"], "S1", 1, ++$Tab);
							echoCellMod($row["S2"], "S2", 2, ++$Tab);
							echoCellMod($row["S3"], "S3", 3, ++$Tab);
							echo "</tr>";
						//Link Amp
							echo "<tr><td>Link Amp</td>";
							echo "<td></td>";
							echoCellMod($row["RML"], "RML", 2, ++$Tab);
							echoCellMod($row["VML"], "VML", 3, ++$Tab);
							echo "</tr>";
						//Heat Sink
							echo "<tr><td>Heat Sink</td>";
							echoCellMod($row["CMH"], "CMH", 1, ++$Tab);
							echoCellMod($row["RMH"], "RMH", 2, ++$Tab);
							echoCellMod($row["VMH"], "VMH", 3, ++$Tab);
							echo "</tr>";
						//Multi hack
							echo "<tr><td>Multi hack</td>";
							echoCellMod($row["CMM"], "CMM", 1, ++$Tab);
							echoCellMod($row["RMM"], "RMM", 2, ++$Tab);
							echoCellMod($row["VMM"], "VMM", 3, ++$Tab);
							echo "</tr>";
						//Force Amp
							echo "<tr><td>Force Amp</td>";
							echo "<td></td>";
							echoCellMod($row["RMF"], "RMF", 2, ++$Tab);
							echo "<td></td>";
							echo "</tr>";
						//Turret
							echo "<tr><td>Turret</td>";
							echo "<td></td>";
							echoCellMod($row["RMT"], "RMT", 2, ++$Tab);
							echoCellMod($row["VMT"], "VMT", 3, ++$Tab);
							echo "</tr>";
						//Capsule
							echo "<tr><td>Capsule</td>";
							echo "<td></td>";
							//Comes after power cubes
							echoCellMod($row["RC"], "RC", 2, $Tab+9);
							echo "<td></td>";
							echo "</tr>";
						//Power cubes fit in here in tab order
							$Tab +=8;
						//Keys
							echo "<tr><td>Keys</td>";
							echoCellMod($row["K1"], "K1", 4, ++$Tab);
							echo "<td></td>";
							echo "<td></td>";
							echo "</tr>";
						//Ap
							$result = selectFrom("AgentTable", array("username"), array($_SESSION['name']));
							$User = mysqli_fetch_array($result, MYSQL_ASSOC);
							
							echo "<tr><td>AP</td>";
							echoCellMod($User['AP'], "AP", 0, ++$Tab);
							echo "<td></td>";
							echo "<td></td>";
							echo "</tr>";
					?>
				</table>
				<br>
				<div id="lineTall"><input class="button" type="submit" value="Update" tabindex=<?php echo ++$Tab;?>></div>
		</form></p>
	</body>
</html>
