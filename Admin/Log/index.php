<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}
?>
<html>
	<head>
	 	<title>Resistance</title>
		<link rel="stylesheet" type="text/css" href="/Ingress/Users/style.css">
		<link rel="shortcut icon" href="/Ingress/icon.png" />
	</head>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<div id="line"><div id="left">
			<?php 
				echo nl2br(file_get_contents('/var/www/Ingress/Data/Log.txt', FILE_USE_INCLUDE_PATH));
			?>
		</div></div>
	</body>
</html>
