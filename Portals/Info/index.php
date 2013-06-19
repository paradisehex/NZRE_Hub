<?php
	session_start();
	//Check if logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$name = strip_tags(stripslashes($_GET['PortalName']));

		$sql="SELECT * FROM PortalTable WHERE portalName='$name'";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);

		$result=mysqli_query($con,"SELECT * FROM PortalTable WHERE portalName = \"".$name."\"");
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	}
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<?php
				echo file_get_contents('/var/www/Ingress/.data/Portals/'.$name .'.html', FILE_USE_INCLUDE_PATH);
			?>
		</p>
	</body>
</html>
