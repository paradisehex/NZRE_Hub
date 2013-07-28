<?php
	session_start();
	if(!$_SESSION['name']){header("location:/Ingress");}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<br>
		<div id="line">
			<div id="left">
				<p>
					This website was created by Tom (GrayGhost).<br>
					It's purpose is to allow the New Zealand Resistance<br> to be more organised.
				</p>
				<p>
					Only level 8 agents can change their own level.<br>If you need your level changed ask an area officer.<br>
				</p>
				<p>
					This is how the permission system works.<br>
					Captains can choose officers.<br>
					Area officers and captains can: <br>
					register players,<br>
					set player's areas,<br>
					and set player's levels.<br>
					By default level 7 and up can view other agents inventorys.
					Anyone can choose the required level to view their inventory.
					Level 5 and up can use enemy agent dossiers.
				</p>
				<p>
					Any suggestions are welcome.<br>
					You can find me on G+ or email me<br>
					grayghost.ingress@gmail.com
				</p>
				<p>
					Active users: <?php
						include "/var/www/Ingress/Tools/database.php";

						$sql="SELECT * FROM ItemTable";
						$result=mysqli_query($con,$sql);

						$count = 0;
						$now = time();


						while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
							$monthNum = 0;
							switch($row['month']){
								case "Jan"	:	$monthNum = 1;	break;
								case "Feb"	:	$monthNum = 2;	break;
								case "Mar"	:	$monthNum = 3;	break;
								case "Apr"	:	$monthNum = 4;	break;
								case "May"	:	$monthNum = 5;	break;
								case "Jun"	:	$monthNum = 6;	break;
								case "Jul"	:	$monthNum = 7;	break;
								case "Aug"	:	$monthNum = 8;	break;
								case "Sep"	:	$monthNum = 9;	break;
								case "Oct"	:	$monthNum = 10;	break;
								case "Nov"	:	$monthNum = 11;	break;
								case "Dec"	:	$monthNum = 12;	break;
							}
							$your_date = strtotime("20".$row['year']."/".$monthNum."/".$row['day']);
							$datediff = $now - $your_date;
							$Days = floor($datediff/(60*60*24));
							if($Days<=7){++$count;}
						}

						echo $count;

					?><br>
					(Users who update their inventory at least once a week)
				</p>
			</div>
		</div>
	</body>
</html>
