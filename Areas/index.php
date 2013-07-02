<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		$sql="SELECT * FROM LocationTable";
		$result=mysqli_query($con,$sql);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<! Menu Starts>
			<?php include "/var/www/Ingress/Tools/menu.php";?>
		<! Menu ends>
		<div id="line">
			Areas
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=New Zealand">New Zealand</a>
		</div>

		<br>

		<div id="line">North Island</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Northland">Northland</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Auckland">Auckland</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Waikato">Waikato</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Bay of Plenty">Bay of Plenty</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Gisborne">Gisborne</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Hawke's Bay">Hawke's Bay</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Taranaki">Taranaki</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Manawatu-Wanganui">Manawatu-Wanganui</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Wellington">Wellington</a>
		</div>

		<br>

		<div id="line">
			South Island
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Nelson-Tasman">Nelson-Tasman</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Marlborough">Marlborough</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=West Coast">West Coast</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Canterbury">Canterbury</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Otago">Otago</a>
		</div>

		<div id="line">
			<a href="/Ingress/Areas/Info/?Name=Southland">Southland</a>
		</div>
	</body>
</html>
