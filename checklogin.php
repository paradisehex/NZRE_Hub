<?php
session_start();

$_SESSION['name'] = "Not Null";
$_SESSION['path'] = getcwd();

include $_SESSION['path']."/Tools/database.php";
include $_SESSION['path']."/Tools/log.php";
include $_SESSION['path']."/Tools/password.php";


$username = stripslashes($_POST['TheUserName']); 
$password = $_POST['ThePassword']; 


if(checkPassword($username,$password,$con)){

	if(check_user_agent('mobile')) {
		$_SESSION['view'] = "Mobile";
	} else {
		$_SESSION['view'] = "Desktop";
	}
	
	
	//Don't log me (I log in a lot)
	if($username!="GrayGhost"){
		LogText("User ".$username." Logged in");	
	}

	header("location:/Ingress/Users");
}
else {
	$_SESSION['name'] = null;
	LogText("User ".$username." Failed to login");
	echo "<html><head>
			<title>Resistance</title>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
			<link rel=\"shortcut icon\" href=\"icon.png\" />
			</head><body>You made a mistake or you're a frog.
		</body></html>";
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
