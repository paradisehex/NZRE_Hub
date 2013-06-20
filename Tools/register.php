<?php
	function register($con,$username,$password,$level){
		//Add password and user to data base
			mysqli_query($con,"insert into AgentTable values('$username','$password',false,$level,0,0);");
			mysqli_query($con,"insert into ItemTable values('$username',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'Never',0);");
		//Go to tools page
			LogText("User ".$_SESSION['name']." Registered ".$username);
	}
?>
