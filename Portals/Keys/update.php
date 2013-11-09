<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		
		$IDs = array();
		$result = selectFrom("PortalTable", null, null);
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			array_push($IDs,$row['ID']);
		}
		
		foreach($IDs as $ID){
			$NewKeys = $_POST[$ID];
			if($NewKeys==""){$NewKeys=0;}
			
			$OldKeysQuerry = selectFrom("KeyTable", array("username","portalID"), array($_SESSION['name'],$ID));
			$OldKeysArray = mysqli_fetch_array($OldKeysQuerry);
			$OldKeys = $OldKeysArray['NumKeys'];
			
			if($OldKeys != $NewKeys){
				deleteFrom("KeyTable", array("username","portalID"), array($_SESSION['name'],$ID));
				if($NewKeys != 0){
					insert("KeyTable", array($_SESSION['name'], $ID, $NewKeys));
				}
			}
		}
		header("location:../");
?>
