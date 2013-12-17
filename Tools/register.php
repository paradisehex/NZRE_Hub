<?php
	include $_SESSION['path']."/Tools/password.php";

	function register($username,$password,$level){
		$password = getHash($username,$password);
		//Add password and user to data base
			insertCertainVaules("AgentTable", array("username", "passwordHash", "Admin", "lvl", "AP", "Location", "InLvl", "outLvl"), array($username,$password,false,$level,0,0,7,7));
			insert("ItemTable",array($username,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'Never',0));
		//Go to tools page
			LogText("User ".$_SESSION['name']." Registered ".$username);
	}
?>
