<?php
	session_start();
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/getPortalInfo.php";

	$Name = strip_tags(stripslashes($_GET['Name']));

	$ThePortal = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM PortalTable WHERE portalName='$Name'"));
	$Location = $ThePortal["Location"];
	$Status = $ThePortal["Status"];
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			<form action="save.php" method="post" autocomplete="off">
				Editing <?php echo $Name;?> Portal<br>
				<input class="field" type="text" name="Name" autocomplete="off" <?php echo "value=\"".$Name."\"";?>><br>
				<select name="Location">
					<?php
						for($i = 0; $i <= $NumOfLocation; $i++){
							echo "<option value=\"".$i."\" ";
							if($Location == $i){echo "selected=\"selected\"";}
							echo ">".getLocationName($i)."</option>";
						}
					?>
				</select><br>
				<select name="Status">
					<?php
						for($i = 0; $i <= $NumOfStatus; $i++){
							echo "<option value=\"".$i."\" ";
							if($Status == $i){echo "selected=\"selected\"";}
							echo ">".getPortalStatus($i)."</option>";
						}
					?>
				</select><br>
				<input type="hidden" name="ID"  <?php echo "value=\"".getPortalID($Name)."\"";?>>
				<input class="field" type="text" name="Latitude" placeholder="Latitude" autocomplete="off" <?php echo "value=\"".($ThePortal["Lat"]/1000000)."\"";?>><br>
				<input class="field" type="text" name="Longitude" placeholder="Longitude" autocomplete="off" <?php echo "value=\"".($ThePortal["Lon"]/1000000)."\"";?>><br>
				<input class="button" type="submit" value="Save" >
			</form>
		</p>

		Officers please only use this for important portals<br><br>

		<div id="line"><a <?php echo "href=\"../Info/?Name=".$Name."\"";?>>Cancel</a></div>
	</body>
</html>
