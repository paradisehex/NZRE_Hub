<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include $_SESSION['path']."/Tools/database.php";
		$result = selectFrom("LocationTable", null, null);
	}
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<! Menu Starts>
			<?php include $_SESSION['path']."/Tools/menu.php";?>
		<! Menu ends>
		
		
		<div id="line">
			Areas
		</div>
		
		<br>
		
		<div width="480" style="position:fixed;left: 50%;margin-left: -240px;">
			<img src="../image.png" width="480" height="618" alt="No frogs allowed">
			<a class="plain" style="position:absolute; top:70px; left:200px;" href="/Ingress/Areas/Info/?Name=Northland">Northland</a>
			<a class="plain" style="position:absolute; top:120px; left:230px;" href="/Ingress/Areas/Info/?Name=Auckland">Auckland</a>
			<a class="plain" style="position:absolute; top:180px; left:250px;" href="/Ingress/Areas/Info/?Name=Waikato" >Waikato</a>
			<a class="plain" style="position:absolute; top:150px; left:350px;" href="/Ingress/Areas/Info/?Name=Bay of Plenty">Bay of Plenty</a>
			<a class="plain" style="position:absolute; top:195px; left:390px;" href="/Ingress/Areas/Info/?Name=Gisborne">Gisborne</a>
			<a class="plain" style="position:absolute; top:240px; left:380px;" href="/Ingress/Areas/Info/?Name=Hawke's Bay">Hawke's Bay</a>
			<a class="plain" style="position:absolute; top:220px; left:230px;" href="/Ingress/Areas/Info/?Name=Taranaki">Taranaki</a>
			<a class="plain" style="position:absolute; top:260px; left:180px;" href="/Ingress/Areas/Info/?Name=Manawatu-Wanganui">Manawatu/Wanganui</a>
			<a class="plain" style="position:absolute; top:310px; left:320px;" href="/Ingress/Areas/Info/?Name=Wellington">Wellington</a>
			<a class="plain" style="position:absolute; top:310px; left:130px;" href="/Ingress/Areas/Info/?Name=Nelson-Tasman">Nelson/Tasman</a>
			<a class="plain" style="position:absolute; top:360px; left:200px;" href="/Ingress/Areas/Info/?Name=Marlborough">Marlborough</a>
			<a class="plain" style="position:absolute; top:370px; left:100px;" href="/Ingress/Areas/Info/?Name=West Coast">West Coast</a>
			<a class="plain" style="position:absolute; top:410px; left:210px;" href="/Ingress/Areas/Info/?Name=Canterbury">Canterbury</a>
			<a class="plain" style="position:absolute; top:455px; left:185px;" href="/Ingress/Areas/Info/?Name=Otago">Otago</a>
			<a class="plain" style="position:absolute; top:490px; left:75px;" href="/Ingress/Areas/Info/?Name=Southland">Southland</a>
		</div>
		
		<div id="line">
			<a class="plain" href="/Ingress/Areas/Info/?Name=New Zealand">New Zealand</a>
		</div>
	</body>
</html>
