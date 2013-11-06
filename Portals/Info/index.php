<?php
	session_start();
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/getPortalInfo.php";

	$Name = strip_tags(stripslashes($_GET['Name']));

	$ThePortal = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM PortalTable WHERE portalName='$Name'"));
	$TheKeys = mysqli_query($con,"SELECT * FROM KeyTable WHERE portalName='$Name'");
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			<?php
				echo "<b>".$ThePortal['PortalName']."</b>";
				echo "<div id=\"LineWideTall\"><div id=\"Left\"><b>Latitude</b></div><div id=\"Right\">".($ThePortal['Lat']/1000000)."</div></div>";
				echo "<div id=\"LineWideTall\"><div id=\"Left\"><b>Longitude</b></div><div id=\"Right\">".($ThePortal['Lon']/1000000)."</div></div>";
				echo "<div id=\"LineWideTall\"><div id=\"Left\"><b>Area</b></div><div id=\"Right\">".getLocationName($ThePortal['Location'])."</div></div>";
				echo "<div id=\"LineWideTall\"><div id=\"Left\"><b>Status</b></div><div id=\"Right\">".getPortalStatus($ThePortal['Status'])."</div></div>";
				echo "<br>";
				echo "<a href=\"https://ingress.com/intel?latE6=".$ThePortal['Lat'].";lngE6=".$ThePortal['Lon'].";z=17;\">Intel Map</a>";
				if(IsOfficer($con,$_SESSION['name'])){
					echo "<br><a href=\"../Edit/?Name=$Name\">Edit</a>";
					echo "<form action=\"delete.php\" method=\"post\" autocomplete=\"off\">";
						echo "<input type=\"hidden\" name=\"Name\" value=\"".$Name."\">";
						echo "<input class=\"button\" type=\"submit\" value=\"Delete\">";
					echo "</form>";
				}
				
				echo "<br><div id=\"Line\">List of keys</div>";
				
				$Keys = mysqli_query($con,"SELECT * FROM KeyTable WHERE portalID = '".getPortalID($ThePortal['PortalName'])."'");
				while ($row = mysqli_fetch_array($Keys, MYSQL_ASSOC)) {
					echo "<div id=\"Line\"><div id=\"Left\">".$row['username']."</div><div id=\"Right\">".$row['NumKeys']."</div></div><br>";
				}
			?>
		</p>
	</body>
</html>
