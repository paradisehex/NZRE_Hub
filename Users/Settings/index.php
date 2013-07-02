<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<br>
		<form action="changepw.php" method="post" autocomplete="off">
			<div id="line">Change Password</div>
			<div id="line"><input class="field" type="password" name="OldPassword" placeholder="Old Password"></div>
			<div id="line"><input class="field" type="password" name="NewPassword" placeholder="New Password"></div>
			<div id="line"><input class="field" type="password" name="NewPassword2" placeholder="Confirm Password"></div>
			<div id="line"><input class="button" type="submit" value="Change" ></div>
		</form>


		<form action="changeAP.php" method="post" autocomplete="off">
			<div id="line">Change AP</div>
			<div id="line"><input class="field" type="text" name="AP" placeholder="Action points"></div>
			<div id="line"><input class="button" type="submit" value="Change" ></div>
		</form>


		<?php
			if($_SESSION['lvl']>=8){
				echo "<form action=\"changelvl.php\" method=\"post\">";
					echo "<div id=\"line\">Change level</div>";
					echo "<div id=\"line\"><input class=\"field\" type=\"text\" name=\"Level\" autocomplete=\"off\" placeholder=\"New Level\"></div>";
					echo "<div id=\"line\"><input type=\"hidden\" value=\"".$_SESSION['name']."\" name=\"Name\"></div>";
					echo "<div id=\"line\"><input class=\"button\" type=\"submit\" value=\"Change\"></div>";
				echo "</form>";
			}
		?>
		<div id="line">
			<a href="ViewingLevel">Set inventory viewing permissions</a>
		</div>

	</body>
</html>
