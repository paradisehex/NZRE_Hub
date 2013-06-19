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
		<p><form name="LoginForm" action="changepw.php" method="post">
				<div id="line">
					Change Password
				</div>
				<div id="line">
					<input class="field" type="password" name="OldPassword" placeholder="Old Password">
				</div>
				<div id="line">
					<input class="field" type="password" name="NewPassword" placeholder="New Password">
				</div>
				<div id="line">
					<input class="field" type="password" name="NewPassword2" placeholder="Confirm Password">
				</div>
				<div id="line">
					<input class="button" type="submit" value="Change" >
				</div>
		</form></p>
		<p><form name="LoginForm" action="changeAP.php" method="post">
				<div id="line">
					Change AP
				</div>
				<div id="line">
					<input class="field" type="text" name="AP" placeholder="Action points">
				</div>
				<div id="line">
					<input class="button" type="submit" value="Change" >
				</div>
		</form></p>
		<?php
			if($_SESSION['lvl']>=8){
				echo "<form action=\"changelvl.php\" method=\"post\">";
					echo "<div id=\"line\">Change level<br><input class=\"field\" type=\"text\" name=\"Level\" autocomplete=\"off\" placeholder=\"New Level\"></div>";
					echo "<input type=\"hidden\" value=\"".$_SESSION['name']."\" name=\"Name\">";
					echo "<div id=\"line\"><input class=\"button\" type=\"submit\" value=\"Update\"></div>";
				echo "</form>";
			}
		?>
	</body>
</html>
