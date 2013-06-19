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
			echo "<div id=\"line\"><b>".$name."</b> Infomation</div>";


			if($row['admin']!=""){
				echo "<div id=\"lineWide\"><div id=\"left\">Officer:</div><div id=\"right\">".$row['admin']."</div></div>";
			}

			echo "<br>";
			echo "<div id=\"whiteSpace\">";
			$text = file_get_contents('/var/www/Ingress/Data/Areas/'.$name.'.txt', FILE_USE_INCLUDE_PATH);
			$text  = format_comment($text);
			echo $text;
			
			echo "</div><br>";


			if($row['admin']==$_SESSION['name']){
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

			echo "<a href=\"StandingOrders/?Name=".$name."\">Standing Orders</a>"; 
			echo "<div id=\"lineE\"><a href=\"Enemies/?Name=".$name."\">Enemy Agents</a></div>"; 
		?>
		<div id="line">Agents:</div>
		<?php
			include "/var/www/Ingress/Tools/userList.php";

			$sql="SELECT * FROM AgentTable WHERE Location=".$row['id'];
			$result = mysqli_query($con,$sql);

			echoAgentsLocation($result,$con,$row['id']);
			
		?>
		<?php
			$Damage = 0;
			$sql="SELECT * FROM AgentTable WHERE Location=".$row['id'];
			$result = mysqli_query($con,$sql);
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$ItemString = "SELECT * FROM ItemTable WHERE username='".$row['username']."'";
				$ItemQuery = mysqli_query($con,$ItemString);
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
