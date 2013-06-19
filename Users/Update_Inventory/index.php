<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$sql="SELECT * FROM ItemTable WHERE username = \"".$_SESSION['name']."\"";
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p><form name="LoginForm" action="updateinv.php" method="post" class="inventory">
				Update Inventory<br>
				<?php

				function echoLine($Num,$ID,$Name,$Des){
					echo "<div id=\"lineTall\"><div id=\"Left\">".$Name."</div><div id=\"Right\">";
					if($Num!=0){
						echo "<input class=\"fieldShort\" type=\"text\" name=\"".$ID."\" autocomplete=\"off\" placeholder=\"".$Des."\" value=\"".$Num."\">";
					}else{
						echo "<input class=\"fieldShort\" type=\"text\" name=\"".$ID."\" autocomplete=\"off\" placeholder=\"".$Des."\">";
					}
					echo "</div></div></div>";
				}


				//Resonators
				for ($i = 1; $i <= 8; $i++) {
					echoLine($row["R".$i],"R".$i,"Lvl ".$i." Res","Level ".$i." Resonator");
				}


				//Bursters
				for ($i = 1; $i <= 8; $i++) {
					echoLine($row['X'.$i] , 'X'.$i , "Lvl ".$i." XMP" , "Level ".$i." Bursters");
				}


				//Viruses
				echoLine($row['VJ'] , 'VJ' , "Jarvis V" , "Jarvis Virus");
				echoLine($row['VA'] , 'VA' , "Ada V" , "ADA Refactor");


				//Shields
				echoLine($row['S1'] , 'S1' , "Com Shd" , "Common Shields");
				echoLine($row['S2'] , 'S2' , "Rare Shd" , "Rare Shields");
				echoLine($row['S3'] , 'S3' , "V. Rare Shd" , "Very Rare Shields");

				echoLine($row['MA'] , 'MA' , "Link Amp" , "Link Amp");
				echoLine($row['MH'] , 'MH' , "Heat Sink" , "Heat Sink");
				echoLine($row['MM'] , 'MM' , "Multi-hack" , "Multi-hack");
				echoLine($row['MF'] , 'MF' , "Force Amp" , "Force Amp");
				echoLine($row['MT'] , 'MT' , "Turret" , "Turret");


				//Power Cubes
				for ($i = 1; $i <= 8; $i++) {
					echoLine($row['P'.$i] , 'P'.$i , "Lvl ".$i." PC" , "Level ".$i." Power Cubes");
				}

				
				//Keys
				echoLine($row['K1'] , 'K1' , "Keys" , "Portal Keys");

				//AP
				$UserQuery="SELECT * FROM AgentTable WHERE username = '".$_SESSION['name']."'";
				$UserResult=mysqli_query($con,$UserQuery);
				$User = mysqli_fetch_array($UserResult, MYSQL_ASSOC);
				echoLine($User['AP'] , 'AP' , "AP" , "Action Points");
				
				?>
				
				<div id="lineTall"><input class="button" type="submit" value="Update"></div>
		</form></p>
	</body>
</html>
