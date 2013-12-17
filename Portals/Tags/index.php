<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	
	if(!IsOfficer($con,$_SESSION['name'])){header("location:/Ingress");}
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		
		<div id="line">Edit Tags</div>
		<p>
			<?php
				$Tags = selectFrom("TagTable", null, null);
				
				while ($Tag = mysqli_fetch_array($Tags, MYSQL_ASSOC)){
					echo "<div id=\"Line\"><a href=\"/Ingress/Portals/Tags/Edit/?ID=".$Tag['ID']."\">".$Tag['Name']."</a></div>";
				}
			?>
			<form name="AddTag" action="add.php" method="post">
				<div id="line">
					<input class="fieldShort" type="text" name="TagName" placeholder="Name" style="float: left;">
					<input class="buttonShort" type="submit" value="Add" style="float: right;">
				</div>
			</form>
		</p>
	</body>
</html>
