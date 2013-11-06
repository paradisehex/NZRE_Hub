<?php
	session_start();
	if($_SESSION['lvl']>=8){
		$username=strip_tags(stripslashes($_POST['Name']));
		$lvl=strip_tags(stripslashes($_POST['Level']));
		include $_SESSION['path']."/Tools/database.php";

		$sql = "UPDATE AgentTable SET lvl = '".$lvl."' WHERE username = '".$username."'";
		mysqli_query($con,$sql);

		$_SESSION['lvl'] = $lvl;

		header("location:./");
	}else{
		header("location:/Ingress");
	}
?>
