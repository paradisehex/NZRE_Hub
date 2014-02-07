<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$Name = strip_tags(stripslashes($_POST['Name']));
		$Msg = strip_tags(stripslashes($_POST['Message']));
		
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));

		if(CanVeiwOP($TheOP['ID'], $_SESSION['name']) || !($The_OP['Private'])){
			
			insertCertainVaules("CommentsTable", array("OP_ID", "Msg", "Name", "Time"), array($The_OP['ID'], $Msg, $_SESSION['name'], time()));
			
			header("location:/Ingress/OPS/?Name=".$Name);
		}else{
			header("location:/Ingress");
		}
?>
