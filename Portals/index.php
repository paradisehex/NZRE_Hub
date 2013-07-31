<?php
	session_start();
	
	include "/var/www/Ingress/Tools/database.php";
	include "/var/www/Ingress/Tools/permission.php";
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<?php
				if(IsOfficer($con,$_SESSION['name'])){
					echo "<div id=\"line\"><a href=\"Submit\">Submit Portal</a></div>";
				}
				
				echo "<div id=\"line\"><a href=\"Keys\">Update Keys</a></div><br>";
				
				$Names = array();
				$result = mysqli_query($con,"SELECT * FROM PortalTable");
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
