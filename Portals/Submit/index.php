<?php
	session_start();
	if(!$_SESSION['name']){header("location:/Ingress");return;}
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			<form action="submit.php" method="post" autocomplete="off">
				Submit Portal<br>
				<input class="field" type="text" name="Name" autocomplete="off" placeholder="Portal Name"autocomplete="off"><br>
				<select name="Location">
					<option value="0">Select Location</option>
					<option value="1">Northland</option>
					<option value="2">Auckland</option>
					<option value="3">Waikato</option>
					<option value="4">Bay of Plenty</option>
					<option value="5">Gisborne</option>
					<option value="6">Hawke's Bay</option>
					<option value="7">Taranaki</option>
					<option value="8">Manawatu-Wanganui</option>
					<option value="9">Wellington</option>
					<option value="10">Nelson-Tasman</option>
					<option value="11">Marlborough</option>
					<option value="12">West Coast</option>
					<option value="13">Canterbury</option>
					<option value="14">Otago</option>
					<option value="15">Southland</option>
				</select><br>
				<input class="field" type="text" name="Latitude" placeholder="Latitude" autocomplete="off"><br>
				<input class="field" type="text" name="Longitude" placeholder="Longitude" autocomplete="off"><br>
				<input class="button" type="submit" value="Submit" >
			</form>
		</p>

		Officers please only use this for important portals<br><br>

		<div id="line"><a href="../">Cancel</a></div>
	</body>
</html>
