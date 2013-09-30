<?php
	session_start();
	
	include "/var/www/Ingress/Tools/database.php";
	include "/var/www/Ingress/Tools/permission.php";
?>
<html>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5zupZ-w-cS_pCHib4YpAdcz6ZBs-zpm8&sensor=true"></script>
	<?php include "/var/www/Ingress/Tools/map.php";?>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<div id="map-canvas"/>
	</body>
</html>
