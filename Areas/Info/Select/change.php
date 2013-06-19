<?php
	session_start();
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags(stripslashes($_POST['Name']));
		$Location = strip_tags(stripslashes($_POST['Location']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		$sql="SELECT * FROM LocationTable WHERE ID =".$ID;
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		if(($row['admin']==$_SESSION['name'])||($ID==0)){
			$sql="UPDATE AgentTable set Location =".$ID."  WHERE username = '".$name."'";
			mysqli_query($con,$sql);
			header("location:/Ingress/Areas/Info/Select/?Name=".$Location);
		}else{
			header("location:/Ingress");
		}
	}
?>
