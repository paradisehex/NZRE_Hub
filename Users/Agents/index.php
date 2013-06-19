<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$sql="SELECT * FROM AgentTable";
		$result=mysqli_query($con,$sql);

		include "/var/www/Ingress/Tools/userList.php";

		$sql="SELECT * FROM LocationTable WHERE admin='".$_SESSION['name']."'";
		$count = mysqli_num_rows(mysqli_query($con,$sql));
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<?php
				if($count >0){
					echo "<div id=\"line\"><a href=\"Register\">Register Agent</a></div>";
				}

				echo "<div id=\"line\"><a href=\"/Ingress/Enemies\">Enemy Agents</a></div><br>";

				echoAgentsRanking($result,$con);
			?>
		</p>
	</body>
</html>
