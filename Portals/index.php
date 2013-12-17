<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			<?php
				if(IsOfficer($con,$_SESSION['name'])){
					echo "<div id=\"line\"><a href=\"Submit\">Submit Portal</a></div>";
				}
				
				if(IsOfficer($con,$_SESSION['name'])){
					echo "<div id=\"line\"><a href=\"Tags\">Edit Tags</a></div>";
				}
				
				echo "<div id=\"line\"><a href=\"Keys\">Update Keys</a></div>";
				echo "<div id=\"line\"><a href=\"Map\">Map</a></div><br>";
				
				$Names = array();
				$result = selectFrom("PortalTable", null, null);
				while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					array_push($Names,$row['PortalName']);
				}
				
				natcasesort ($Names);
				
				foreach($Names as $Name){
					echo "<div id=\"Line\"><a href=\"/Ingress/Portals/Info/?Name=".$Name."\">".$Name."</a></div>";
				}
			?>
		</p>
	</body>
</html>
