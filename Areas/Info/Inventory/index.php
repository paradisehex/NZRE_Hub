<?php
	session_start();
	if($_SESSION['lvl']<7){header("location:/Ingress");return;}
		
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$name = strip_tags(stripslashes($_GET['Name']));

		$row = mysqli_fetch_array(selectFrom("LocationTable", array("name"), array($name)));
		
		$AreaOfficers = selectFrom("OfficerTable", array("Location"), array($row['id']));
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<?php
			echo "<div id=\"line\"><b>".$name."</b> Inventory</div>";

			include $_SESSION['path']."/Tools/userList.php";
			include "display.php";


			$result = selectFrom("AgentTable", array("Location"), array($row['id']));

			$i = 0;
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$ItemString = "SELECT * FROM ItemTable WHERE username='".$row['username']."'";
				$ItemQuery = selectFrom("ItemTable", array("username"), array($row['username']));
				$Items = mysqli_fetch_array($ItemQuery, MYSQL_ASSOC);

				addInventory($Items);
				if($Items['year']!=0){$i++;}
			}

			echoInv($i);
			
			echo "<br><br><a href=\"../?Name=".$name."\">Back</a>";
		?>
	</body>
</html>
