<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){header("location:/Ingress");}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<br>
		<div id="line">
			<div id="left">
				<p>
					The website was created by Tom (GrayGhost).<br>
					It's purpose is to allow the New Zealand Resistance<br> to be more organised.
				</p>
				<p>
					Only level 8 agents can change their own level.<br>If you need your level changed ask an area officer.<br>
				</p>
				<p>
					This is how the permission system works.<br>
					Captains can choose officers.<br>
					Area officers and captains can: <br>
					register players,<br>
					set player's areas,<br>
					and set player's levels.<br>
					By default level 7 and up can view other agents inventorys.
					Anyone can choose the required level to view their inventory.
					Level 5 and up can use enemy agent dossiers.
				</p>
				<p>
					Any suggestions are welcome.<br>
					You can find me on G+ or email me<br>
					grayghost.ingress@gmail.com
				</p>
			</div>
		</div>
	</body>
</html>
