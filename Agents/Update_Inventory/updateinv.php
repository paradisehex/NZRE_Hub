<?php
	session_start();

	include $_SESSION['path']."/Tools/database.php";

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
	//Ultra
	$U1 = stripslashes($_POST['U1']);
	$U2 = stripslashes($_POST['U2']);
	$U3 = stripslashes($_POST['U3']);
	$U4 = stripslashes($_POST['U4']);
	$U5 = stripslashes($_POST['U5']);
	$U6 = stripslashes($_POST['U6']);
	$U7 = stripslashes($_POST['U7']);
	$U8 = stripslashes($_POST['U8']);
	//Virus
	$VA = stripslashes($_POST['VA']);
	$VJ = stripslashes($_POST['VJ']);
	//Sheilds
	$S1 = stripslashes($_POST['S1']);
	$S2 = stripslashes($_POST['S2']);
	$S3 = stripslashes($_POST['S3']);
	//Mods
	$CML = stripslashes($_POST['CML']);
	$CMH = stripslashes($_POST['CMH']);
	$CMM = stripslashes($_POST['CMM']);
	$CMF = stripslashes($_POST['CMF']);
	$CMT = stripslashes($_POST['CMT']);

	$RML = stripslashes($_POST['RML']);
	$RMH = stripslashes($_POST['RMH']);
	$RMM = stripslashes($_POST['RMM']);
	$RMF = stripslashes($_POST['RMF']);
	$RMT = stripslashes($_POST['RMT']);

	$VML = stripslashes($_POST['VML']);
	$VMH = stripslashes($_POST['VMH']);
	$VMM = stripslashes($_POST['VMM']);
	$VMF = stripslashes($_POST['VMF']);
	$VMT = stripslashes($_POST['VMT']);
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
	
	
	$Fields = array(
		"R1","R2","R3","R4","R5","R6","R7","R8","X1","X2","X3","X4","X5","X6","X7","X8","U1","U2","U3","U4","U5","U6","U7","U8",
		"VA","VJ","S1","S2","S3","CML","RML","VML","CMH","RMH","VMH","CMM","RMM","VMM","CMF","RMF","VMF","CMT","RMT","VMT",
		"P1","P2","P3","P4","P5","P6","P7","P8","K1",
		"day","month","year"
	);
	
	$Vaules = array(
		$R1,$R2,$R3,$R4,$R5,$R6,$R7,$R8,$X1,$X2,$X3,$X4,$X5,$X6,$X7,$X8,$U1,$U2,$U3,$U4,$U5,$U6,$U7,$U8,
		$VA,$VJ,$S1,$S2,$S3,$CML,$RML,$VML,$CMH,$RMH,$VMH,$CMM,$RMM,$VMM,$CMF,$RMF,$VMF,$CMT,$RMT,$VMT,
		$P1,$P2,$P3,$P4,$P5,$P6,$P7,$P8,$K1,
		date('d',time()),date('M',time()),date('y',time())
	);
	
	update("ItemTable", $Fields, $Vaules, "username", $username);

	$ap=stripslashes($_POST['AP']);
	$maxAP = 20000*pow(2,($_SESSION['lvl']-1));
	if($ap<$maxAP){
		update("AgentTable", array("AP"), array($ap), "username", $username);
	}

	header("location:/Ingress/Agents/?Name=".$username);
?>
