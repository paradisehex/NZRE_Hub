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
			echo "<div id=\"whiteSpace\">";
				echo $row['Description'];
			echo "</div><br>";


			if(OfficerAndLocation($con,$_SESSION['name'],$name)){
				//Edit decsription
				echo "<form class=\"short\" action=\"Edit/\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"Name\" value=\"".$name."\">";
				echo "<input class=\"button\" type=\"submit\" value=\"Edit\" >";
				echo "</form>";

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

			echo "<a href=\"StandingOrders/?Name=".$name."\">Standing Orders</a><br>";
			if($_SESSION['lvl']>=7){echo "<a href=\"Inventory/?Name=".$name."\">Inventory</a>";}
		?>
		<div id="line">Agents:</div>
		<?php
			include $_SESSION['path']."/Tools/userList.php";

			$result = selectFrom("AgentTable", array("Location"), array($row['id']));

			echoAgentsLocation($result,$con,$row['id']);
			
		?>
		<?php
			$Damage = 0;
			$result = selectFrom("AgentTable", array("Location"), array($row['id']));
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$ItemQuery = selectFrom("ItemTable", array("username"), array($row['username']));
				$Items = mysqli_fetch_array($ItemQuery, MYSQL_ASSOC);

				$Damage += ($Items['X1']*150);
				$Damage += ($Items['X2']*300);
				$Damage += ($Items['X3']*500);
				$Damage += ($Items['X4']*900);
				$Damage += ($Items['X5']*1200);
				$Damage += ($Items['X6']*1500);
				$Damage += ($Items['X7']*1800);
				$Damage += ($Items['X8']*2700);
			}
			echo "<div id=\"lineWide\"><div id=\"left\">Potential damage:</div><div id=\"right\">".$Damage."</div></div>";
		?>
	</body>
</html>
