<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		
		$IDs = array();
		$result = mysqli_query($con,"SELECT * FROM PortalTable");
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			array_push($IDs,$row['ID']);
		}
		
		foreach($IDs as $ID){
			$NewKeys = $_POST[$ID];
			if($NewKeys==""){$NewKeys=0;}
			
			$OldKeysQuerry = mysqli_query($con,"SELECT * FROM KeyTable WHERE username = '".$_SESSION['name']."' AND portalID = '".$ID."'");
			$OldKeysArray = mysqli_fetch_array($OldKeysQuerry);
			$OldKeys = $OldKeysArray['NumKeys'];
			
			if($OldKeys != $NewKeys){
				mysqli_query($con,"delete from KeyTable WHERE username = '".$_SESSION['name']."' AND portalID = '".$ID."'");
				if($NewKeys != 0){
					mysqli_query($con,"insert into KeyTable values('".$_SESSION['name']."','$ID','$NewKeys');");
				}
			}
		}
		header("location:../");
?>
