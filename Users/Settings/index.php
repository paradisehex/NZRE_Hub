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
		<form name="LoginForm" action="changepw.php" method="post">
			Change Password<br>
			<input class="field" type="password" name="OldPassword" placeholder="Old Password">
			<input class="field" type="password" name="NewPassword" placeholder="New Password">
			<input class="field" type="password" name="NewPassword2" placeholder="Confirm Password">
			<input class="button" type="submit" value="Change" >
		</form>


		<form name="LoginForm" action="changeAP.php" method="post">
			Change AP<br>
			<input class="field" type="text" name="AP" placeholder="Action points">
			<input class="button" type="submit" value="Change" >
		</form>


		<?php
			if($_SESSION['lvl']>=8){
				echo "<form action=\"changelvl.php\" method=\"post\">";
					echo "Change level<br><input class=\"field\" type=\"text\" name=\"Level\" autocomplete=\"off\" placeholder=\"New Level\">";
					echo "<input type=\"hidden\" value=\"".$_SESSION['name']."\" name=\"Name\">";
					echo "<input class=\"button\" type=\"submit\" value=\"Change\">";
				echo "</form>";
			}
		?>
		<div id="line">
			<a href="ViewingLevel">Set inventory viewing permissions</a>
		</div>
	</body>
</html>
