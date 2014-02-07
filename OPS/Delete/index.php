<?php
	session_start();
	if(!$_SESSION['name']){header("location:/Ingress");return;}
	$Name = strip_tags(stripslashes($_GET['Name']));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			<form action="delete.php" method="post" autocomplete="off">
				Are you sure that you want to delete <?php echo $Name;?>?<br><br>
				<input type="hidden" name="Name" <?php echo "value=\"".$Name."\"";?>>
				<input class="button" type="submit" value="Delete" >
			</form>
		</p>
		<div id="line"><a <?php echo "href=\"../?Name=".$Name."\""?>>Cancel</a></div>
	</body>
</html>
