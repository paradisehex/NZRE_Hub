<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$Name = strip_tags(stripslashes($_GET['Name']));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<br>
			<div id="Line"><?php echo "Changing Operation ".$Name."'s Name"; ?></div><br>
			<form  class="wide" action="save.php" method="post">
			<input class="field" type="text" name="New_Name" autocomplete="off" <?php echo "value='".$Name."'";?>>
				<?php echo "<input type=\"hidden\" name=\"Name\" value=\"".$Name."\">";?>
				<input class="button" type="submit" value="Rename" >
			</form>
			
			<?php
				echo "<a href=\"/Ingress/OPS/?Name=".$Name."\">Cancel</a>";
			?>
	</body>
</html>
