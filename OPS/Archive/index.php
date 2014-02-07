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
			<form action="archive.php" method="post" autocomplete="off">
				Are you sure that you want to archive <?php echo $Name;?>?<br>
				Once archived <?php echo $Name;?> it will become public and uneditable, also any private portals will be added to the public database<br>
				<input type="hidden" name="Name" <?php echo "value=\"".$Name."\"";?>>
				<input class="button" type="submit" value="Archive" >
			</form>
		</p>
		<div id="line"><a <?php echo "href=\"../?Name=".$Name."\""?>>Cancel</a></div>
	</body>
</html>
