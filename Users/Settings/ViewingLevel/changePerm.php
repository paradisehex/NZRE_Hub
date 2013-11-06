<?php
	session_start();
	
		include $_SESSION['path']."/Tools/database.php";
	
		$AnyLvl=strip_tags(stripslashes($_POST['AnyOneLevel']));
		$AreaLvl=strip_tags(stripslashes($_POST['AreaLevel']));

		$sql = "UPDATE AgentTable SET InLvl = '".$AreaLvl."' WHERE username = '".$_SESSION['name']."'";
		mysqli_query($con,$sql);
		$sql = "UPDATE AgentTable SET outLvl = '".$AnyLvl."' WHERE username = '".$_SESSION['name']."'";
		mysqli_query($con,$sql);

		header("location:../");
?>
