<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";

		$name = strip_tags(stripslashes($_GET['Name']));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<div id="Line">
				<?php 
					echo "Veiwing <strong>".$name."</strong>'s verification";
				?>
			</div>
			<div id="Line">
				<?php echo "<div id=\"Location\"><a href=\"/Ingress/Agents/?Name=".$name."\">Back</a></div>"; ?>
			</div>
			<br>
			<div id="Line">
				<table>
					<tr>
						<td style="text-align: center;">Verified by</td>
						<td style="text-align: center;">Verifies</td>
					</tr>
					<?php
						$Verified_Result = selectFrom("VerifyTable", array("Trustee"), array($name));
						$Verifies_Result = selectFrom("VerifyTable", array("Truster"), array($name));
						
						$Verified = array();
						$Verifies = array();
						
						$i1 = 0;
						while ($row = mysqli_fetch_array($Verified_Result, MYSQL_ASSOC)) {
							array_push($Verified, $row['Truster']);
							$i1++;
						}
						
						$i2 = 0;
						while ($row = mysqli_fetch_array($Verifies_Result, MYSQL_ASSOC)) {
							array_push($Verifies, $row['Trustee']);
							$i2++;
						}
						
						if($i2 > $i1){$i1 = $i2;}
						
						$i = 0;
						while($i < $i1){	
							echo "<tr>";
								echo "<td><a class=\"Agent\" style=\"display: inline;\" href=\"/Ingress/Agents/?Name=".$Verified[$i]."\">".$Verified[$i]."</a></td>";
								echo "<td><a class=\"Agent\" style=\"display: inline;\" href=\"/Ingress/Agents/?Name=".$Verifies[$i]."\">".$Verifies[$i++]."</a></td>";
							echo "</tr>";
						}
					?>
				</table>
			</div>
	</body>
</html>
