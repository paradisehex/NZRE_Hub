<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/bb.php";
		include $_SESSION['path']."/Tools/permission.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$row = mysqli_fetch_array(selectFrom("LocationTable", array("name"), array($name)));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\">".$name." Description</div>";


			echo "<div id=\"whiteSpaceWide\">";
				echo format_comment($row['Description']);
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
