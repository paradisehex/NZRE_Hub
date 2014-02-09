<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$Name = strip_tags(stripslashes($_GET['Name']));

		
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));

		$EveryPortal = selectFrom("PortalTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<br>
		<div id="line">
			<?php
				echo "<a href=\"/Ingress/OPS/?Name=".$Name."\">Back</a>";
			?>
		</div>
		<br><div id="Line">Select portals for <?php echo $Name;?></div><br>
			<?php
				echo "<form action=\"change.php\" method=\"post\">";
				
					while ($row = mysqli_fetch_array($EveryPortal, MYSQL_ASSOC)) {
					
						if(0 < mysqli_num_rows(selectFrom("PortalOPTable", array("PortalName ","OP_ID"), array($row['PortalName'],$The_OP['ID'])))){	
							echo "<input class=\"buttonOfficer\" type=\"submit\" name=\"Name\" value=\"".$row['PortalName']."\" >";
						}else{
							echo "<input class=\"button\" type=\"submit\" name=\"Name\" value=\"".$row['PortalName']."\" >";
						}
						
					}
					
					echo "<input type=\"hidden\" name=\"ID\" value=\"".$The_OP['ID']."\">";
				echo "</form>";
			?>
			<form action="submit.php" method="post" autocomplete="off">
				Submit Portal<br>
				<?php echo "<input type=\"hidden\" name=\"ID\" value=\"".$The_OP['ID']."\">";?>
				<input class="field" type="text" name="Name" autocomplete="off" placeholder="Portal Name"autocomplete="off"><br>
				<select name="Location">
					<option value="0">Select Location</option>
					<option value="1">Northland</option>
					<option value="2">Auckland</option>
					<option value="3">Waikato</option>
					<option value="4">Bay of Plenty</option>
					<option value="5">Gisborne</option>
					<option value="6">Hawke's Bay</option>
					<option value="7">Taranaki</option>
					<option value="8">Manawatu-Wanganui</option>
					<option value="9">Wellington</option>
					<option value="10">Nelson-Tasman</option>
					<option value="11">Marlborough</option>
					<option value="12">West Coast</option>
					<option value="13">Canterbury</option>
					<option value="14">Otago</option>
					<option value="15">Southland</option>
				</select><br>
				<select name="Private">
					<option value="0">Public</option>
					<option value="1">Private</option>
				</select>
				<input class="field" type="text" name="Latitude" placeholder="Latitude" autocomplete="off"><br>
				<input class="field" type="text" name="Longitude" placeholder="Longitude" autocomplete="off"><br>
				<input class="button" type="submit" value="Submit" >
			</form>
	</body>
</html>
