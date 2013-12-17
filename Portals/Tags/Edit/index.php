<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	
	if(!IsOfficer($con,$_SESSION['name'])){header("location:/Ingress");}
	
	$ID = strip_tags(stripslashes($_GET['ID']));
	
	$Tags = selectFrom("TagTable", array("ID"), array($ID));
	$Tag = mysqli_fetch_array($Tags, MYSQL_ASSOC);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		
		<div id="line">Editing <?php echo $Tag['Name'];?> Tag</div>
		<p>
			<form name="Rename" action="rename.php" method="post">
				<div id="line">
					<input type="hidden" name="ID" <?php echo "value=\"".$ID."\""?>>
					<input class="field" type="text" name="TagName" placeholder="Name">
					<input class="button" type="submit" value="Rename">
				</div>
			</form>
			
			<form name="Delete" action="delete.php" method="post">
				<div id="line">
					<input type="hidden" name="ID" <?php echo "value=\"".$ID."\""?>>
					<input class="button" type="submit" value="Delete">
				</div>
			</form>
		</p>
	</body>
</html>
