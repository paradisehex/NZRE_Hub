<?php
	ob_start();
	session_start();
	//Check if session is admin.
	if((!$_SESSION['name'])|($_SESSION['lvl']<7)){
		header("location:/Ingress");
	}else{
		
		include "/var/www/Ingress/Tools/database.php";
		include "/var/www/Ingress/Tools/permission.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$sql="SELECT * FROM LocationTable WHERE name='".$name."'";
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
		
		$OfficerQuery="SELECT * FROM OfficerTable WHERE Location='".$row['id']."'";
		$AreaOfficers = mysqli_query($con,$OfficerQuery);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\"><b>".$name."</b> Inventory</div>";
			echo "<a href=\"../?Name=".$name."\">Back</a><br>";

			include "/var/www/Ingress/Tools/userList.php";
			include "display.php";
			//initvar();


			$sql="SELECT * FROM AgentTable WHERE Location=".$row['id'];
			$result = mysqli_query($con,$sql);

			$i = 0;
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$ItemString = "SELECT * FROM ItemTable WHERE username='".$row['username']."'";
				$ItemQuery = mysqli_query($con,$ItemString);
				$Items = mysqli_fetch_array($ItemQuery, MYSQL_ASSOC);

				addInventory($Items);
				if($Items['year']!=0){$i++;}
			}

			echoInv($i);
		?>
	</body>
</html>
