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
				<select name="Status">
					<option value="0">Select Status</option>
					<option value="1">Farm for keys</option>
					<option value="2">Protect</option>
					<option value="3">Destroy</option>
					<option value="4">Agreed shared farm</option>
					<option value="5">Agreed EN farm</option>
					<option value="6">Agreed RE farm</option>
					<option value="7">Keep green</option>
					<option value="8">Don't touch</option>
					<option value="9">Low level only</option>
					<option value="10">Other</option>
				</select><br>
				<input class="field" type="text" name="Latitude" placeholder="Latitude" autocomplete="off"><br>
				<input class="field" type="text" name="Longitude" placeholder="Longitude" autocomplete="off"><br>
				<input class="button" type="submit" value="Submit" >
			</form>
		</p>

		Officers please only use this for strategic portals<br><br>

		<div id="line"><a href="../">Cancel</a></div>
	</body>
</html>
