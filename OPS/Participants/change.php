<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include $_SESSION['path']."/Tools/alert.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$ID = strip_tags(stripslashes($_POST['ID']));

		if(IsCoordintor($ID, $_SESSION['name'])){
		
		$TheOP = mysqli_fetch_array(selectFrom("OPSTable", array("ID"), array($ID)));
		
			if(0 < mysqli_num_rows(selectFrom("ParticipantTable", array("Name","ID"), array($Name,$ID)))){
				if($TheOP['Private']){
					deleteFrom("ParticipantTable", array("Name"), array($Name));
					header("location:./?Name=".$TheOP['Name']);
				}else{
					errorMsg("Participant are only for private OPS","./?Name=".$TheOP['Name']);
				}
			}else{
				insert("ParticipantTable", array($ID,$Name));
				header("location:./?Name=".$TheOP['Name']);
			}
		}else{
			header("location:/Ingress");
		}
?>
