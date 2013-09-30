<?php
	session_start();
	include "/var/www/Ingress/Tools/database.php";
	include "/var/www/Ingress/Tools/permission.php";

	$Name = strip_tags(stripslashes($_GET['Name']));

	$ThePortal = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM PortalTable WHERE portalName='$Name'"));
	$TheKeys = mysqli_query($con,"SELECT * FROM KeyTable WHERE portalName='$Name'");
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<?php
				echo "<b>".$ThePortal['PortalName']."</b>";
				echo "<div id=\"LineWideTall\"><div id=\"Left\"><b>Latitude</b></div><div id=\"Right\">".($ThePortal['Lat']/1000000)."</div></div><br>";
				echo "<div id=\"LineWideTall\"><div id=\"Left\"><b>Longitude</b></div><div id=\"Right\">".($ThePortal['Lon']/1000000)."</div></div><br>";
				echo "<a href=\"https://ingress.com/intel?latE6=".$ThePortal['Lat'].";lngE6=".$ThePortal['Lon'].";z=17;\">Intel Map</a>";
				
				echo "<br><br><div id=\"Line\">List of keys</div>";
				
				$Keys = mysqli_query($con,"SELECT * FROM KeyTable WHERE portalName = '".$ThePortal['PortalName']."'");
				while ($row = mysqli_fetch_array($Keys, MYSQL_ASSOC)) {
					echo "<div id=\"Line\"><div id=\"Left\">".$row['username']."</div><div id=\"Right\">".$row['NumKeys']."</div></div><br>";
				}
				
				if(IsOfficer($con,$_SESSION['name'])){
					echo "<form action=\"delete.php\" method=\"post\" autocomplete=\"off\">";
						echo "<input type=\"hidden\" name=\"Name\" value=\"".$Name."\">";
						echo "<input class=\"button\" type=\"submit\" value=\"Delete\">";
					echo "</form>";
				}
			?>
		</p>
	</body>
</html>
