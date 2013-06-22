<?php
	ob_start();
	session_start();
	
	if(!$_SESSION['name']){header("location:/Ingress");}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p><form action="register.php" method="post" autocomplete="off">
				Register User<br>
				<input class="field" type="text" name="TheUserName" autocomplete="off" placeholder="User Name"autocomplete="off"><br>
				<input class="field" type="text" name="Level" autocomplete="off" placeholder="Access Level" autocomplete="off"><br>
				<input class="field" type="password" name="ThePassword3" placeholder="Password" autocomplete="off"><br>
				<input class="field" type="password" name="ThePassword2" placeholder="Confirm Password" autocomplete="off"><br>
				<input class="button" type="submit" value="Register" >
		</form></p>
		Warning Only Admins can Remove Agents Acounts
	</body>
</html>
