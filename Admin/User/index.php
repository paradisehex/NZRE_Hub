<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$sql="SELECT * FROM AgentTable WHERE username = \"".$name."\"";
		$row=mysqli_fetch_array(mysqli_query($con,$sql));
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<?php
				echo "<b>".$row['username']." Level ".$row['lvl']."</b>";
				//Delete
				echo "<div id=\"line\"><form name=\"DeleteUser\" action=\"delete.php\" method=\"post\"><input class=\"button\" type=\"submit\" value=\"Delete\">";
				echo "<input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\"></form></div>";
				//Op
				echo "<div id=\"line\">";
				if($row['Admin']){
					echo "<form name=\"ChangePassword\" action=\"deop.php\" method=\"post\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
					echo "<input class=\"button\" type=\"submit\" value=\"Remove Admin\"></form>";
				}else{
					echo "<form name=\"ChangePassword\" action=\"op.php\" method=\"post\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
					echo "<input class=\"button\" type=\"submit\" value=\"Make Admin\"></form>";
				}
				echo "</div><br>";
				//Change passwd
				echo "<div id=\"block\"><form name=\"ChangePassword\" action=\"change.php\" method=\"post\" autocomplete=\"off\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
				echo "<input class=\"field\" type=\"password\" name=\"ThePassword\" placeholder=\"Change Password\">";
				echo "<input class=\"button\" type=\"submit\" value=\"Change\"></form></div><br><br>";
				//Change Level
				echo "<div id=\"block\"><form name=\"ChangePassword\" action=\"changelvl.php\" method=\"post\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
				echo "<input class=\"field\" type=\"text\" name=\"Level\" autocomplete=\"off\" placeholder=\"Change Level\">";
				echo "<input class=\"button\" type=\"submit\" value=\"Change\"></form></div>";
		?>
		</p>
	</body>
</html>
