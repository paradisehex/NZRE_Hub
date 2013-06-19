<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$sql="SELECT * FROM AgentTable";
		$result= mysqli_query($con,$sql);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\">Select New Admin for <b>".$name."</b></div>";
			echo "<form action=\"changeAdmin.php\" method=\"post\">";
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<input class=\"button\" type=\"submit\" name=\"User\" value=\"".$row['username']."\">";
			}
			echo "<input class=\"button\" type=\"submit\" name=\"User\" value=\"\">";
			echo "<input type=\"hidden\" name=\"LocationName\" value=\"".$name."\">";
			echo "</form>";
		?>
	</body>
</html>
