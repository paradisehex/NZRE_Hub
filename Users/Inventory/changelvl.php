<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$sql="SELECT * FROM LocationTable WHERE admin='".$_SESSION['name']."'";
		$count = mysqli_num_rows(mysqli_query($con,$sql));

		if($count>0){
			$username=strip_tags(stripslashes($_POST['Name']));
			$lvl=strip_tags(stripslashes($_POST['Level']));
			$sql = "UPDATE AgentTable SET lvl = '".$lvl."' WHERE username = '".$username."'";
			mysqli_query($con,$sql);
			header("location:./?Name=".$username);
		}else{
			header("location:/Ingress");
		}
	}
?>
