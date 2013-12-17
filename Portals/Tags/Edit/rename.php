<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		
		$ID = strip_tags(stripslashes($_POST['ID']));
		$Name = strip_tags(stripslashes($_POST['TagName']));
		
		if(IsOfficer($con,$_SESSION['name'])){
			$result = selectFrom("TagTable", array("Name"), array($Name));
			$count = mysqli_num_rows($result);
			if($count == 0){
				update("TagTable", array("Name"), array($Name), "ID", $ID);
				header("location:../");
			}else{
				echo "Name Taken";
			}
		}else{
			header("location:/Ingress");
		}
?>
