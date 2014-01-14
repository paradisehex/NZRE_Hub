<?php	
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	
	$Trustee = $_POST['Name'];
	$Truster = $_SESSION['name'];
	
	$Result = selectFrom("VerifyTable", array("Truster", "Trustee"), array($Truster, $Trustee));
	
	$Count = mysqli_num_rows($Result);
	
	if($Count == 1){
		deleteFrom("VerifyTable", array("Truster", "Trustee"), array($Truster, $Trustee));
	}else{
		insertCertainVaules("VerifyTable", array("Truster", "Trustee"), array($Truster, $Trustee));
	}
	
	header("location:/Ingress/Agents/?Name=".$Trustee);
?>
