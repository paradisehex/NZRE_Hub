<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";

		$ID = strip_tags(stripslashes($_POST['ID']));

		$The_Comment = mysqli_fetch_array(selectFrom("CommentsTable", array("ID"), array($ID)));
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("ID"), array($The_Comment['OP_ID'])));
		
		if(canEditComment($The_Comment['Name'], $The_Comment['OP_ID'])){
			deleteFrom("CommentsTable", array("ID"), array($ID));
			
			header("location:../?Name=".$The_OP['Name']);
		}	
?>
