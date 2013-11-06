<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";

	$name = strip_tags(stripslashes($_POST['Name']));
		
	if(!OfficerAndLocation($con,$_SESSION['name'],$name)){header("location:/Ingress");}
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<br>
			<div id="Line"><?php echo "Editing ".$name." Description"; ?></div>
			<div id="Block">
			<form action="save.php" method="post">
				<textarea class="R" name="message"><?php echo file_get_contents('/var/www/Ingress/.data/Areas/'.$name.'.txt', FILE_USE_INCLUDE_PATH);?></textarea>
				<?php echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\">";?>
				<input class="button" type="submit" value="Save" >
			</form>
		</div>
	</body>
</html>
