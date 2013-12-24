<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	
	$Location = strip_tags(stripslashes($_GET['Location']));
	$Tag = strip_tags(stripslashes($_GET['Tag']));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<div id="line">Filtered Portals</div>
		<p>
			<?php
				
				if($Location != 0){
					$Portals = selectFrom("PortalTable", array("Location"), array($Location));
				}else{
					$Portals = selectFrom("PortalTable", null, null);
				}
				
				$Names = array();
				
				if($Tag != 0){	
					while ($row = mysqli_fetch_array($Portals, MYSQL_ASSOC)) {
						$PortalTags = selectFrom("PortalTagTable", array("portalID", "tagID"), array($row['ID'], $Tag));
						$Count = mysqli_num_rows($PortalTags);
						
						if($Count == 1){
							array_push($Names,$row['PortalName']);
						}
					}
				}else{
					while ($row = mysqli_fetch_array($Portals, MYSQL_ASSOC)) {array_push($Names,$row['PortalName']);}
				}
				
				natcasesort ($Names);
				
				foreach($Names as $Name){
					echo "<div id=\"Line\"><a href=\"/Ingress/Portals/Info/?Name=".$Name."\">".$Name."</a></div>";
				}
			?>
		</p>
	</body>
</html>
