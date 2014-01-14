<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/alert.php";
		
		$Name = strip_tags(stripslashes($_POST['TagName']));
		
		if(IsOfficer($con,$_SESSION['name'])){
			$result = selectFrom("TagTable", array("Name"), array($Name));
			$count = mysqli_num_rows($result);
			if($count == 0){
				insertCertainVaules("TagTable", array("Name"), array($Name));
				header("location:./");
			}else{
				errorMsg("Tag Name Taken","./");
			}
		}else{
			header("location:/Ingress");
		}
?>
