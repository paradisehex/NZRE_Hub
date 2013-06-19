<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p><form action="register.php" method="post">
				Register User<br>
				<input class="field" type="text" name="TheUserName" autocomplete="off" placeholder="User Name">
				<input class="field" type="text" name="Level" autocomplete="off" placeholder="Access Level">
				<input class="field" type="password" name="ThePassword3" placeholder="Password">
				<input class="field" type="password" name="ThePassword2" placeholder="Confirm Password">
				<input class="button" type="submit" value="Register" >
		</form></p>
	</body>
</html>
