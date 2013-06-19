<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/bb.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$sql="SELECT * FROM LocationTable WHERE name='".$name."'";
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\">".$name." Standing Orders</div>";


			echo "<div id=\"whiteSpaceWide\">";
			$text  = file_get_contents('/var/www/Ingress/.data/Areas/StandingOrders/'.$name.'.txt', FILE_USE_INCLUDE_PATH);
			$text  = format_comment($text);
			echo $text;
			echo "</div><br><br>";


			if($row['admin']==$_SESSION['name']){
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
