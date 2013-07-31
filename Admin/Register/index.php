<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p><form action="register.php" method="post" autocomplete="off">
				Register User<br>
				<input class="field" type="text" name="TheUserName" autocomplete="off" placeholder="User Name"><br>
				<input class="field" type="text" name="Level" autocomplete="off" placeholder="Access Level"><br>
				<input class="field" type="password" name="ThePassword3" placeholder="Password"><br>
				<input class="field" type="password" name="ThePassword2" placeholder="Confirm Password"><br>
				<input class="button" type="submit" value="Register" >
		</form></p>
	</body>
</html>
