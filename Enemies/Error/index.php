<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){header("location:/Ingress");return;}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?><br>
		Restricted Access<br>
		You must be at least level 5 to use the Enemy Intel
	</body>
</html>
