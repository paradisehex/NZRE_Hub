<?php
	function checkPassword($Name, $Password){
		$PasswordHash = getHash($Name, $Password);
		
		$Result = selectFrom("AgentTable", array("username", "passwordHash"), array($Name, $PasswordHash));

		$count = mysqli_num_rows($Result);
		
		if($count==1){
			$row = mysqli_fetch_array($Result);
			$_SESSION['name'] = $row['username'];
			$_SESSION['admin'] = $row['Admin'];
			$_SESSION['lvl'] = $row['lvl'];
			return true;
		}


		return false;
	}
	
	function getHash($Name, $Password){
		return hash('whirlpool', md5(strtolower($Name)).$Password);
	}
?>
