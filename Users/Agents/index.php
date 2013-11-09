<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/userList.php";
		
		$result = selectFrom("AgentTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			<?php
				if(IsOfficer($con,$_SESSION['name'])){
					echo "<div id=\"line\"><a href=\"Register\">Register Agent</a></div><br>";
				}

				echoAgentsRanking($result,$con);
			?>
		</p>
	</body>
</html>
