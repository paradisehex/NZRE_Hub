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


				//Mods
				echoLine($row['S1'] , 'S1' , "C Shield" , "Common Shields");
				echoLine($row['S2'] , 'S2' , "R Shield" , "Rare Shields");
				echoLine($row['S3'] , 'S3' , "VR Shield" , "Very Rare Shields");

				echoLine($row['CML'] , 'CML' , "C Link Amp" , "Common Link Amp");
				echoLine($row['RML'] , 'RML' , "R Link Amp" , "Link Amp");
				echoLine($row['VML'] , 'VML' , "VR Link Amp" , "Link Amp");

				echoLine($row['CMH'] , 'CMH' , "C Heat Sink" , "Common Heat Sink");
				echoLine($row['RMH'] , 'RMH' , "R Heat Sink" , "Rare Heat Sink");
				echoLine($row['VMH'] , 'VMH' , "VR Heat Sink" , "Very Rare Heat Sink");

				//echoLine($row['CMM'] , 'CMM' , "C Multi-hack" , "Common Multi-hack");
				echoLine($row['RMM'] , 'RMM' , "R Multi-hack" , "Rare Multi-hack");
				//echoLine($row['VMM'] , 'VMM' , "VR Multi-hack" , "Very Rare Multi-hack");

				//echoLine($row['CMF'] , 'CMF' , "C Force Amp" , "Common Force Amp");
				echoLine($row['RMF'] , 'RMF' , "R Force Amp" , "Rare Force Amp");
				//echoLine($row['VMF'] , 'VMF' , "VR Force Amp" , "Very Rare Force Amp");

				//echoLine($row['CMT'] , 'CMT' , "C Turret" , "Common Turret");
				echoLine($row['RMT'] , 'RMT' , "R Turret" , "Rare Turret");
				//echoLine($row['VMT'] , 'VMT' , "VR Turret" , "Very Rare Turret");

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
