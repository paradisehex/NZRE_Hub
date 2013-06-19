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
					Only level 8 agents can change their own level.<br>If you need your level changed ask your area officer.<br>
					If you try to set your AP to much higher than<br>
					what's possible with your level it will fail.
				</p>
				<p>
					This is how the permsion system works:<br>
					Area Officers can register players, set player's areas,<br>set player's levels and delete enemy players.<br>
					Level 7 and 8 players can see anyone's inventory.<br>
					Level 6 and down can see people's inventory if the person is<br>the same level as them or lower and in their area.<br>
					Level 5 and up can view, add and edit enemy agent dossiers.
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
