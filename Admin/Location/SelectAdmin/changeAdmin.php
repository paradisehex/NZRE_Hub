<?php
	session_start();
	if(!$_SESSION['admin']){header("location:/Ingress");return;}
	
	$locationName = strip_tags(stripslashes($_POST['LocationName']));
	$Name = strip_tags(stripslashes($_POST['User']));

	include "/var/www/Ingress/Tools/database.php";

	$sql = "UPDATE LocationTable SET admin = '".$Name."' WHERE name = '".$locationName."'";
	echo $sql;
	mysqli_query($con,$sql);
	header("location:/Ingress/Admin/Location");
?>
