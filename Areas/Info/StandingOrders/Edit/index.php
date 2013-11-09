<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$name = strip_tags(stripslashes($_POST['Name']));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<br>
			<div id="Line"><?php echo "Editing ".$name." Description"; ?></div>
			<form  class="wide" action="save.php" method="post">
				<textarea class="R" name="message" style="height:500px"><?php echo file_get_contents($_SESSION['path'].'/.data/Areas/StandingOrders/'.$name.'.txt', FILE_USE_INCLUDE_PATH);?></textarea>
				<?php echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\">";?>
				<input class="button" type="submit" value="Save" >
			</form>
	</body>
</html>
