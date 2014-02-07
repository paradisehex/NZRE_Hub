<?php
	session_start();
	if(!$_SESSION['name']){header("location:/Ingress");return;}
	/*
		Name
		Descripton
		Key Portals (after sumbit)
		other Ordernaters
	*/
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			<form action="Intialize.php" method="post" autocomplete="off">
				Intialize OP<br>
				<input class="field" type="text" name="Name" autocomplete="off" placeholder="Operation Name" autocomplete="off"><br>
				<select name="Privacy">
					<option value="0">Public</option>
					<option value="1">Private</option>
				</select><br>
				<input class="button" type="submit" value="Intialize" >
			</form>
		</p>
		<div id="line"><a href="../">Cancel</a></div>
		<br>
		Warning even when an OP is private site admins can still access it.<br>
	</body>
</html>
