<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
?>
<html>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5zupZ-w-cS_pCHib4YpAdcz6ZBs-zpm8&sensor=true"></script>
	<?php include $_SESSION['path']."/Tools/map.php";?>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<div id="map-canvas"/>
	</body>
</html>
