<?php
	session_start();
	include $_SESSION['path']."/Tools/database.php";
	
	$result = selectFrom("AgentTable", array("username"), array($_SESSION['name']));
	$User = mysqli_fetch_array($result, MYSQL_ASSOC);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<div id="Line">
			Settings
		</div>

		<br>
		
		<form action="changeAP.php" method="post" autocomplete="off">
			<div id="line">Change AP</div>
			<div id="line"><input class="field" type="text" name="AP" placeholder="Action points" value=<?php echo "\"".$User['AP']."\""?>></div>
			<div id="line"><input class="button" type="submit" value="Change" ></div>
		</form>


		
		<form action="changelvl.php" method="post">
			<div id="line">Change level</div>
			<div id="line"><input class="field" type="text" name="Level" autocomplete="off" placeholder="New Level" value=<?php echo "\"".$User['lvl']."\""?>></div>
			<div id="line"><input class="button" type="submit" value="Change"></div>
		</form>
		

		<form action="changePerm.php" method="post">
			<div id="line">Change Viewing Degree</div>
			<div id="line"><input class="field" type="text" name="Degree" placeholder="Degree" value=<?php echo "\"".$User['ViewDegree']."\""?>></div>
			<div id="line"><input class="button" type="submit" value="Change" ></div>
		</form>


		<form action="changepw.php" method="post" autocomplete="off">
			<div id="line">Change Password</div>
			<div id="line"><input class="field" type="password" name="OldPassword" placeholder="Old Password"></div>
			<div id="line"><input class="field" type="password" name="NewPassword" placeholder="New Password"></div>
			<div id="line"><input class="field" type="password" name="NewPassword2" placeholder="Confirm Password"></div>
			<div id="line"><input class="button" type="submit" value="Change" ></div>
		</form>
	</body>
</html>
