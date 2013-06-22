<?php
	session_start();
	if($_SESSION['name']){
		$AnyLvl=strip_tags(stripslashes($_POST['AnyOneLevel']));
		$AreaLvl=strip_tags(stripslashes($_POST['AreaLevel']));

		include "/var/www/Ingress/Tools/database.php";

		$sql = "UPDATE AgentTable SET InLvl = '".$AreaLvl."' WHERE username = '".$_SESSION['name']."'";
		mysqli_query($con,$sql);
		$sql = "UPDATE AgentTable SET outLvl = '".$AnyLvl."' WHERE username = '".$_SESSION['name']."'";
		mysqli_query($con,$sql);

		header("location:../");
	}else{
		header("location:/Ingress");
	}
?>
