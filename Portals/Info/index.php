<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$Name = strip_tags(stripslashes($_GET['Name']));

		$ThePortal = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM PortalTable WHERE portalName='$Name'"));
		$TheKeys = mysqli_query($con,"SELECT * FROM KeyTable WHERE portalName='$Name'");
	}
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
			?>
		</p>
	</body>
</html>
