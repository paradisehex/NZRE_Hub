<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/getPortalInfo.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$Portals = selectFrom("PortalTable", array("Location"), array(getPortalID($name)));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\"><b>".$name."</b> Portals</div>";

			$Names = array();
			while ($row = mysqli_fetch_array($Portals, MYSQL_ASSOC)) {
				array_push($Names,$row['PortalName']);
			}
				
			natcasesort($Names);

			foreach($Names as $Name){
				echo "<div id=\"Line\"><a href=\"/Ingress/Portals/Info/?Name=".$Name."\">".$Name."</a></div>";
			}
			
			echo "<br><br><a href=\"../?Name=".$name."\">Back</a>";
		?>
	</body>
</html>
