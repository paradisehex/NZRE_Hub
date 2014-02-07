<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$ID = strip_tags(stripslashes($_GET['ID']));
		$The_Comment = mysqli_fetch_array(selectFrom("CommentsTable", array("ID"), array($ID)));
		$TheOP = mysqli_fetch_array(selectFrom("OPSTable", array("ID"), array($The_Comment['OP_ID'])));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
			<br>
			<div id="Line"><?php echo "Editing Comment"; ?></div>
			<form  class="wide" action="save.php" method="post">
				<textarea class="R" name="message" style="height:60px"><?php echo $The_Comment['Msg']?></textarea>
				<?php echo "<input type=\"hidden\" name=\"ID\" value=\"".$ID."\">";?>
				<input class="button" type="submit" value="Save" style="float:right;width:100px;">
			</form>
			<br>
			
			<form  class="wide" action="delete.php" method="post">
				<?php echo "<input type=\"hidden\" name=\"ID\" value=\"".$ID."\">";?>
				<input class="button" type="submit" value="Delete">
			</form>
			<div id="Line">
				<?php echo "<a href='../?Name=".$TheOP['Name']."'>Cancel</a>";?>
			</div>
	</body>
</html>
