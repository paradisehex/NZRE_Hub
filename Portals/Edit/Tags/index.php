<?php
	session_start();
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/getPortalInfo.php";

	$Name = strip_tags(stripslashes($_GET['Name']));
	$ID = strip_tags(stripslashes($_GET['ID']));

	//$ThePortal = mysqli_fetch_array(selectFrom("PortalTable", array("portalName"), array($Name)));
	
	
	$TheTags = selectFrom("TagTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<div id="Line">Selecting tags for <?php echo $Name;?> Portal<br></div>
		<div id="line"><a <?php echo "href=\"../?Name=".$Name."\"";?>>Back</a></div>
		<p>
			<form action="change.php" method="post" autocomplete="off">
				<?php
					echo "<input type=\"hidden\" name=\"Name\" value=\"".$Name."\">";
					echo "<input type=\"hidden\" name=\"ID\" value=\"".$ID."\">";
					
					while ($row = mysqli_fetch_array($TheTags, MYSQL_ASSOC)) {
						$count = mysqli_num_rows(selectFrom("PortalTagTable", array('portalID','tagID'), array($ID,$row['ID'])));
						if($count > 0){
							echo "<input class=\"buttonOfficer\" type=\"submit\" name=\"Tag\" value=\"".$row['Name']."\">";
						}else{
							echo "<input class=\"button\" type=\"submit\" name=\"Tag\" value=\"".$row['Name']."\">";
						}
					}
				?>
			</form>
		</p>
	</body>
</html>
