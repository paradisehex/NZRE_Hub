<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$Name = strip_tags(stripslashes($_GET['Name']));

		$ThePortal = mysqli_query($con,"SELECT * FROM PortalTable WHERE portalName='$Name'");
		$TheKeys = mysqli_query($con,"SELECT * FROM KeyTable WHERE portalName='$Name'");
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<?php
				echo $Name;
			?>
		</p>
	</body>
</html>
