<?php
	session_start();
	if(!$_SESSION['name']){header("location:/Ingress");return;}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<form action="submit.php" method="post" autocomplete="off">
				Submit Portal<br>
				<input class="field" type="text" name="Name" autocomplete="off" placeholder="Portal Name"autocomplete="off"><br>
				<input class="field" type="text" name="Location" autocomplete="off" placeholder="Location ID (Northland is 1)" autocomplete="off"><br>
				<input class="field" type="text" name="Latitude" placeholder="Latitude" autocomplete="off"><br>
				<input class="field" type="text" name="Longitude" placeholder="Longitude" autocomplete="off"><br>
				<input class="button" type="submit" value="Submit" >
			</form>
		</p>

		Officers please only use this for strategic portals<br><br>

		<div id="line"><a href="../">Cancel</a></div>
	</body>
</html>
