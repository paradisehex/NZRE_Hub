<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$Name = strip_tags(stripslashes($_GET['Name']));
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<br>
			<div id="Line"><?php echo "Editing Operation ".$Name."'s Description"; ?></div>
			<form  class="wide" action="save.php" method="post">
				<textarea class="R" name="message" style="height:500px"><?php echo $The_OP['Description']?></textarea>
				<?php echo "<input type=\"hidden\" name=\"Name\" value=\"".$Name."\">";?>
				<input class="button" type="submit" value="Save" >
			</form>
	</body>
</html>
