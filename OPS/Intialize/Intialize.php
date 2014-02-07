<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/alert.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$Privacy = strip_tags(stripslashes($_POST['Privacy']));

		$result = selectFrom("OPSTable", array("Name"), array($Name));
		$count = mysqli_num_rows($result);
		
		if($count == 0){
		
			insertCertainVaules("OPSTable", array("Name", "Private", "Description"), array($Name, $Privacy, "[color=white]No description yet.[/color]"));
			
			$TheOP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
			insertCertainVaules("CoordinatorTable", array("ID", "Name"), array($TheOP['ID'], $_SESSION['name']));
			
			header("location:../?Name=".$Name);
			
		}else{
		
			errorMsg("Name taken","./");
			
		}
?>
