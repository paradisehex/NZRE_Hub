<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/bb.php";
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
			echo "<div id=\"line\"><b>".$name."</b> Infomation</div>";


			if($row['admin']!=""){
				echo "<div id=\"lineWide\"><div id=\"left\">Captain:</div><div id=\"right\">".$row['admin']."</div></div><br>";
			}
			while ($Officer = mysqli_fetch_array($AreaOfficers, MYSQL_ASSOC)) {
				echo "<div id=\"lineWide\"><div id=\"left\">Officer:</div><div id=\"right\">".$Officer['username']."</div></div><br>";
			}

			echo "<br>";


			if(OfficerAndLocation($con,$_SESSION['name'],$name)){
				//Set people location
				echo "<form  class=\"short\" action=\"Select/\" method=\"get\">";
				echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\">";
				echo "<input class=\"button\" type=\"submit\" value=\"Add or Remove Agents\" >";
				echo "</form>";
			}
			if(CaptainAndLocation($con,$_SESSION['name'],$name)){
				//Pick Officers
				echo "<form  class=\"short\" action=\"Officers/\" method=\"get\">";
				echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\">";
				echo "<input class=\"button\" type=\"submit\" value=\"Select Officers\" >";
				echo "</form>";
			}

			echo "<a href=\"Description/?Name=".$name."\">Description</a><br>";
			if($_SESSION['lvl']>=7){echo "<a href=\"Inventory/?Name=".$name."\">Inventory</a>";}
		?>
		<div id="line">Agents:</div>
		<?php
			include $_SESSION['path']."/Tools/userList.php";

			$result = selectFrom("AgentTable", array("Location"), array($row['id']));

			echoAgentsLocation($result,$con,$row['id']);
		?>
	</body>
</html>
