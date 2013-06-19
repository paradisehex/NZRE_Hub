<?php
	session_start();

	if(!$_SESSION['name']){
		header("location:/Ingress");
	}else{
		include "/var/www/Ingress/Tools/database.php";

		$username=$_SESSION['name'];
	
		//Res
		$R1 = stripslashes($_POST['R1']);
		$R2 = stripslashes($_POST['R2']);
		$R3 = stripslashes($_POST['R3']);
		$R4 = stripslashes($_POST['R4']);
		$R5 = stripslashes($_POST['R5']);
		$R6 = stripslashes($_POST['R6']);
		$R7 = stripslashes($_POST['R7']);
		$R8 = stripslashes($_POST['R8']);
		//Xmp
		$X1 = stripslashes($_POST['X1']);
		$X2 = stripslashes($_POST['X2']);
		$X3 = stripslashes($_POST['X3']);
		$X4 = stripslashes($_POST['X4']);
		$X5 = stripslashes($_POST['X5']);
		$X6 = stripslashes($_POST['X6']);
		$X7 = stripslashes($_POST['X7']);
		$X8 = stripslashes($_POST['X8']);
		//Virus
		$VA = stripslashes($_POST['VA']);
		$VJ = stripslashes($_POST['VJ']);
		//Sheilds
		$S1 = stripslashes($_POST['S1']);
		$S2 = stripslashes($_POST['S2']);
		$S3 = stripslashes($_POST['S3']);
		//Mods
		$MA = stripslashes($_POST['MA']);
		$MH = stripslashes($_POST['MH']);
		$MM = stripslashes($_POST['MM']);
		$MF = stripslashes($_POST['MF']);
		$MT = stripslashes($_POST['MT']);
		//Power Cubes
		$P1 = stripslashes($_POST['P1']);
		$P2 = stripslashes($_POST['P2']);
		$P3 = stripslashes($_POST['P3']);
		$P4 = stripslashes($_POST['P4']);
		$P5 = stripslashes($_POST['P5']);
		$P6 = stripslashes($_POST['P6']);
		$P7 = stripslashes($_POST['P7']);
		$P8 = stripslashes($_POST['P8']);
		//Key
		$K1 = stripslashes($_POST['K1']);

		$Res = "R1 = '".$R1."',R2 = '".$R2."',R3 = '".$R3."',R4 = '".$R4."',R5 = '".$R5."',R6 = '".$R6."',R7 = '".$R7."',R8 = '".$R8."',";
		$Xmp = "X1 = '".$X1."',X2 = '".$X2."',X3 = '".$X3."',X4 = '".$X4."',X5 = '".$X5."',X6 = '".$X6."',X7 = '".$X7."',X8 = '".$X8."',";
		$Vir = "VA = '".$VA."',VJ = '".$VJ."',";
		$She = "S1 = '".$S1."',S2 = '".$S2."',S3 = '".$S3."',";
		$Mod = "MA = '".$MA."',MH = '".$MH."',MM = '".$MM."',MF = '".$MF."',MT = '".$MT."',";
		$Pow = "P1 = '".$P1."',P2 = '".$P2."',P3 = '".$P3."',P4 = '".$P4."',P5 = '".$P5."',P6 = '".$P6."',P7 = '".$P7."',P8 = '".$P8."',";
		$Key = "K1 = '".$K1."',";

		$sql = "UPDATE ItemTable SET ".$Res.$Xmp.$Vir.$She.$Mod.$Pow.$Key."day=".date('d',time()).",month='".date('M',time())."',year=".date('y',time())." WHERE username = '".$username."'";
		mysqli_query($con,$sql);

		$ap=stripslashes($_POST['AP']);
		$maxAP = 20000*pow(2,($_SESSION['lvl']-1));
		if($ap<$maxAP){
			$sql = "UPDATE AgentTable SET AP = '".$ap."' WHERE username = '".$username."'";
			mysqli_query($con,$sql);
		}

		header("location:/Ingress/Users");
	}
?>
