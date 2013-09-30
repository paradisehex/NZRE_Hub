<?php
	function checkPassword($Name,$Password,$con){
		$OldPassword = md5($Password);
		$NewPassword =getHash($Name,$Password);

		$OldSQL = "SELECT * FROM AgentTable WHERE username='$Name' and password='$OldPassword'";
		$NewSQL = "SELECT * FROM AgentTable WHERE username='$Name' and passwordHash='$NewPassword'";

		$OldResult = mysqli_query($con,$OldSQL);
		$NewResult = mysqli_query($con,$NewSQL);

		$Oldcount = mysqli_num_rows($OldResult);
		$Newcount = mysqli_num_rows($NewResult);

		//echo $NewPassword."<br>";


		if($Oldcount==1){
			$row = mysqli_fetch_array($OldResult);
			$_SESSION['name'] = $row['username'];
			$_SESSION['admin'] = $row['Admin'];
			$_SESSION['lvl'] = $row['lvl'];
			
			$sql2 = "UPDATE AgentTable SET password = '' WHERE username = '".$Name."'";
			mysqli_query($con,$sql2);

			$sql2 = "UPDATE AgentTable SET passwordHash = '".$NewPassword."' WHERE username = '".$Name."'";
			mysqli_query($con,$sql2);

			return true;
		}


		if($Newcount==1){
			$row = mysqli_fetch_array($NewResult);
			$_SESSION['name'] = $row['username'];
			$_SESSION['admin'] = $row['Admin'];
			$_SESSION['lvl'] = $row['lvl'];
			return true;
		}


		return false;
	}




	function getHash($Name,$Password){
		return hash('whirlpool',md5($Name).$Password);
	}
?>
