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
				<div id="hovButton">
					Location
					<div id="hovButtonHolder">
						<input class="button" type="submit" value="Northland" >
						<input class="button" type="submit" value="Auckland" >
						<input class="button" type="submit" value="Waikato" >
						<input class="button" type="submit" value="Bay of Plenty" >
						<input class="button" type="submit" value="Gisborne" >
						<input class="button" type="submit" value="Hawke's Bay" >
						<input class="button" type="submit" value="Taranaki" >
						<input class="button" type="submit" value="Manawatu-Wanganui" >
						<input class="button" type="submit" value="Wellington" >
						<input class="button" type="submit" value="Nelson-Tasman" >
						<input class="button" type="submit" value="Marlborough" >
						<input class="button" type="submit" value="West Coast" >
						<input class="button" type="submit" value="Canterbury" >
						<input class="button" type="submit" value="Otago" >
						<input class="button" type="submit" value="Southland" >
					</div>
				</div>
				<input class="field" type="text" name="Latitude" placeholder="Latitude" autocomplete="off"><br>
				<input class="field" type="text" name="Longitude" placeholder="Longitude" autocomplete="off"><br>
				<input class="button" type="submit" value="Submit" >
			</form>
		</p>

		Officers please only use this for strategic portals<br><br>

		<div id="line"><a href="../">Cancel</a></div>
	</body>
</html>
