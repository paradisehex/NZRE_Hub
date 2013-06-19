<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<?php
				echo file_get_contents('/var/www/Ingress/Portals/Portals.html', FILE_USE_INCLUDE_PATH);
			?>
		</p>
	</body>
</html>
