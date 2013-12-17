<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		
		$TagName = strip_tags(stripslashes($_POST['Tag']));
		$Name = strip_tags(stripslashes($_POST['Name']));
		$PortalID = strip_tags(stripslashes($_POST['ID']));
		
		if(IsOfficer($con,$_SESSION['name'])){
			$Tag = mysqli_fetch_array(selectFrom("TagTable", array('Name'), array($TagName)));
			
			$count = mysqli_num_rows(selectFrom("PortalTagTable", array('portalID','tagID'), array($PortalID,$Tag['ID'])));
			
			if($count > 0){
				deleteFrom("PortalTagTable", array('portalID','tagID'), array($PortalID,$Tag['ID']));
			}else{
				insert("PortalTagTable", array($PortalID,$Tag['ID']));
			}
			echo $Tag['ID'];
			header("location:./?Name=".$Name."&ID=".$PortalID);
			
		}else{
			header("location:/Ingress");
		}
?>
