<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";	

		$username=$_SESSION['name'];
		$ap=stripslashes($_POST['AP']);
		$maxAP = 20000*pow(2,($_SESSION['lvl']-1));

		if($ap<$maxAP){
			$sql = "UPDATE AgentTable SET AP = '".$ap."' WHERE username = '".$username."'";
			mysqli_query($con,$sql);
		}

		header("location:/Ingress/Users");
	}
?>
