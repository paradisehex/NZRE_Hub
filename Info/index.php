<?php
	session_start();
	if(!$_SESSION['name']){header("location:/Ingress");return;}
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<br>
		<div id="line">
			<div id="left">
				<p>
					This website was created by Tom (GrayGhost).<br>
					It's purpose is to allow the New Zealand Resistance<br> to be more organised.
				</p>
				<p>
					Captains can choose officers.<br>
					Area officers and captains can: <br>
					register players<br>
					and set player's areas.<br>
				</p>
					The +1 buttons are part of a verification system.<br>
					If you know and trust an agent please +1 them.<br>
					This data is used for two things:<br>
					1) There is a map of who trusts who to help us identify dodgy agents<br>
					2) You can control who can view your inventory by setting your "Viewing Degree" in settings.<br>
					For example a Viewing Degree of 2 means your +1's +1's can view your Inventory.
				<p>
					Any suggestions are welcome.<br>
					You can find me on G+ or email me<br>
					grayghost.ingress@gmail.com
				</p>
				<p>
					Active users: <?php
						include $_SESSION['path']."/Tools/database.php";

						$result = selectFrom("ItemTable", null, null);

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
					(Users who updated their inventory in the last week)
				</p>
			</div>
		</div>
	</body>
</html>
