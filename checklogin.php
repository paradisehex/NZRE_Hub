<?php
ob_start();
session_start();
// Connect to MYSQL server
include "/var/www/Ingress/Tools/database.php";
include "/var/www/Ingress/Tools/log.php";

// Define $myusername and $mypassword 
$username=stripslashes($_POST['TheUserName']); 
$password=md5($_POST['ThePassword']); 

$sql="SELECT * FROM AgentTable WHERE username='$username' and password='$password'";
$result=mysqli_query($con,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	// Register $myusername, $mypassword
	$row = mysqli_fetch_array($result);
	$_SESSION['name'] = $row['username'];
	$_SESSION['admin'] = $row['Admin'];
	$_SESSION['lvl'] = $row['lvl'];
	$_SESSION['view'] = "Desktop";
	
	//Don't log me (I log in a lot)
	if($username!="GrayGhost"){
		LogText("User ".$username." Logged in");	
	}

	header("location:/Ingress/Users");
}
else {
	LogText("User ".$username." Failed to login");
	echo "<html><head>
			<title>Resistance</title>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
			<link rel=\"shortcut icon\" href=\"icon.png\" />
			</head><body>You made a mistake or you're a frog.
		</body></html>";
}
ob_end_flush();
?>
