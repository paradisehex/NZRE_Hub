<?php
	session_start();
	
		include "/var/www/Ingress/Tools/database.php";
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");return;}
		
		$name = strip_tags(stripslashes($_POST['username']));
		$sql="SELECT * FROM EnemyTable WHERE username = \"".$name."\"";
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
			<br>
			<div id="LineE"><?php echo "<div id=\"lvl".$row['lvl']."\">"."Veiwing ".$name." Level ".$row['lvl']."</div>"; ?></div>
		<div id="Block">


			<form class="e" action="changelvl.php" method="post">
					Update Level<br>
					<input class="fielde" type="text" name="Level" autocomplete="off" placeholder="New Level"><br>
					<?php echo "<input type=\"hidden\" name=\"username\" value=\"".$name."\">";?>
					<input class="buttone" type="submit" value="Change" >
			</form>
			<br>

			<form class="e" action="delete.php" method="post">
				<?php echo "<input type=\"hidden\" name=\"username\" value=\"".$name."\">";?>
				Delete Agent<br>
				<input class="buttone" type="submit" value="Delete" >
			</form>
		</div>
	</body>
</html>
