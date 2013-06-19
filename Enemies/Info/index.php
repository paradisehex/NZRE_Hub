<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		if($_SESSION['lvl']<5){header("location:/Ingress/Enemies/Error");}
		$name = strip_tags(stripslashes($_GET['Name']));

		include "/var/www/Ingress/Tools/database.php";
		$sql="SELECT * FROM EnemyTable WHERE username = \"".$name."\"";
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$Location = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM LocationTable WHERE id = ".$row['Location']), MYSQL_ASSOC);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
			<br>
			<div id="LineE"><?php echo "<div id=\"lvl".$row['lvl']."\">"."Veiwing ".$name." Level ".$row['lvl']."</div>"; ?></div>
			<?php echo "<div id=\"LocationE\"><a href=\"/Ingress/Areas/Info/?Name=".$Location['name']."\">Area  ".$Location['name']."</a></div>"; ?>
			<div id="LineE">
				<?php
					echo "Last updated on the ".$row['day']." of ".$row['month']." 20".$row['year'];
				?>
			</div>
			<div id="Text">
				<?php
					echo file_get_contents('/var/www/Ingress/.data/Enemies/'.$name.'.txt', FILE_USE_INCLUDE_PATH);
				?>
			</div>
			<p><form action="Edit/index.php" method="post">
				<?php echo "<input type=\"hidden\" name=\"username\" value=\"".$name."\">"; ?>
				<input class="buttone" type="submit" value="Edit" >
			</form>

			<div id="LineE">
				<?php echo "<a href=\"./Location/?Name=".$name."\">Change Location</a>";?>
			</div><br>
			</p>
	</body>
</html>
