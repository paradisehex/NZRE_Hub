<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/bb.php";
		include $_SESSION['path']."/Tools/permission.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$sql="SELECT * FROM LocationTable WHERE name='".$name."'";
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\">".$name." Standing Orders</div>";


			echo "<div id=\"whiteSpaceWide\">";
			$text  = file_get_contents('/var/www/Ingress/.data/Areas/StandingOrders/'.$name.'.txt', FILE_USE_INCLUDE_PATH);
			$text  = format_comment($text);
			echo $text;
			echo "</div><br><br>";


			if(OfficerAndLocation($con,$_SESSION['name'],$name)){
				//Edit decsription
				echo "<div id=\"line\"><form action=\"Edit/\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\">";
				echo "<input class=\"button\" type=\"submit\" value=\"Edit\" >";
				echo "</form></div>";
			}
			echo "<a href=\"/Ingress/Areas/Info/?Name=".$name."\">Back</a>";
		?>
	</body>
</html>
