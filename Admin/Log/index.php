<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
		include $_SESSION['path']."/Tools/database.php";
		$result= selectFrom("LogTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<div id="line"><a href="../">Back</a></div>
		<?php
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				echo "<div id=\"line\"><div id=\"Left\">".$row['Time']."</div><div id=\"Right\">".$row['Message']."</div></div><br>";
			}
		?>
	</body>
</html>
