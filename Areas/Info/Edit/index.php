<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		
		if(!OfficerAndLocation($con,$_SESSION['name'],$name)){header("location:/Ingress");}
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
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
