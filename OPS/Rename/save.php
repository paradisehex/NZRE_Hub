<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/alert.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$New_Name = strip_tags(stripslashes($_POST['New_Name']));
		
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));

		if(IsCoordintor($TheOP['ID'], $_SESSION['name'])){
		
		$result = selectFrom("OPSTable", array("Name"), array($New_Name));
		$count = mysqli_num_rows($result);
		
		if($count == 0){
			update("OPSTable", array("Name"), array($New_Name), "Name", $Name);
			
			header("location:/Ingress/OPS/?Name=".$New_Name);
		}else{
			errorMsg("Name taken","./OPS/?Name=".$Name);
		}
		
		
		}else{
			header("location:/Ingress");
		}
?>
