<?php
session_start();

$_SESSION['name'] = "Not Null";
$_SESSION['path'] = getcwd();

include $_SESSION['path']."/Tools/database.php";
include $_SESSION['path']."/Tools/log.php";
include $_SESSION['path']."/Tools/password.php";


$username = stripslashes($_POST['TheUserName']); 
$password = $_POST['ThePassword'];

//If there's no admin create Ada
$Result = selectFrom("AgentTable", array("Admin"), array(true));
if(mysqli_num_rows($Result) == 0){
	insertCertainVaules("AgentTable",array("username","passwordHash","Admin"),array("Ada","dddb74c0532bf2886ee5cafab8f13d16798012d6f853d23aee5ec18be6152170e94286c42a4fceed50703e305376a91a35121035f0ba33c53ce8a71bff0f067b",true));
}

//Update old password
$hash = hash('whirlpool', md5($username).$password);
$Result = selectFrom("AgentTable", array("username", "passwordHash"), array($username,$hash));
if(mysqli_num_rows($Result) == 1){
	LogText("Updated ".$username."'s password");
	update("AgentTable", array("passwordHash"), array(getHash($username, $password)), "username", $username);
}
//End update


if(checkPassword($username,$password)){
	if(check_user_agent('mobile')) {
		$_SESSION['view'] = "Mobile";
	} else {
		$_SESSION['view'] = "Desktop";
	}
	
	
	//Don't log me (I log in a lot)
	if($username!="GrayGhost"){
		LogText("User ".$username." Logged in");
	}

	header("location:/Ingress/Home");
}
else {
	$_SESSION['name'] = null;
	LogText("User ".$username." Failed to login");
	echo "<html><head>
			<title>Resistance</title>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"/Ingress/CSS/Login/style.css\">
			<link rel=\"shortcut icon\" href=\"icon.png\" />
			</head>
				<body>
					<div id=\"Line\" style=\"color:#FF0000;text-shadow: 0 0 5px; font-weight:bold;\">ERROR</div>
					<br>
					Someone made a mistake or you're a frog.
					<br><br>
					<div id=\"Line\">
						<a href=\"./\">Back</a>
					</div>
				</body>
			</html>";
}



/* USER-AGENTS
================================================== */
function check_user_agent ( $type = NULL ) {
        $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
        if ( $type == 'bot' ) {
                // matches popular bots
                if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
                        return true;
                        // watchmouse|pingdom\.com are "uptime services"
                }
        } else if ( $type == 'browser' ) {
                // matches core browser types
                if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
                        return true;
                }
	} else if ( $type == 'mobile' ) {
                // matches popular mobile devices that have small screens and/or touch inputs
                // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
                // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
		if ( preg_match ("/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
                        // these are the most common
                        return true;
                } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
                        // these are less common, and might not be worth checking
                        return true;
                }
        }
        return false;
}
?>
