<?php
	session_start();
		include "/var/www/Ingress/Tools/database.php";
		
		$Names = array();
		$result = mysqli_query($con,"SELECT * FROM PortalTable");
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			array_push($Names,$row['PortalName']);
		}
				
		natcasesort ($Names);
		
		foreach($Names as $Name){
			$NewKeys = $_POST[str_replace(" ","",$Name)];
			if($NewKeys==""){$NewKeys=0;}
			
			$OldKeysQuerry = mysqli_query($con,"SELECT * FROM KeyTable WHERE username = '".$_SESSION['name']."' AND portalName = '".$Name."'");
			$OldKeysArray = mysqli_fetch_array($OldKeysQuerry);
			$OldKeys = $OldKeysArray['NumKeys'];
			
			if($OldKeys != $NewKeys){
				mysqli_query($con,"delete from KeyTable WHERE username = '".$_SESSION['name']."' AND portalName = '".$Name."'");
				if($NewKeys != 0){
					mysqli_query($con,"insert into KeyTable values('".$_SESSION['name']."','$Name','$NewKeys');");
				}
			}
		}
		header("location:../");
?>
