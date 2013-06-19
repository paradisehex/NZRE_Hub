<?php
	session_start();
	if(!$_SESSION['admin']){
		header("location:/Ingress");
	}else{


		$username=strip_tags(stripslashes($_POST['Name']));
		include "/var/www/Ingress/Tools/database.php";

		//Delete them
			mysqli_query($con,"delete from AgentTable where username = '".$username."'");
			mysqli_query($con,"delete from ItemTable where username = '".$username."'");


		//Go back to tools
			header("location:/Ingress/Admin");
	}
?>
