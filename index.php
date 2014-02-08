
<?php
	session_start();
	session_destroy();

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
<html>
	<head>
		<title>NZRE Hub</title>
		<meta http-equiv="Content-Language" content="en"/>
		<link rel="stylesheet" type="text/css" href="/Ingress/CSS/Login/<?php echo check_user_agent("mobile")?"mobile.css":"style.css"; ?>">
		<link rel="shortcut icon" href="/Ingress/icon.png" />
	</head>
	<body>
		<div id="line" >
			<div id="Title">
				NZRE Hub
			</div>
		</div>
		<form name="LoginForm" action="checklogin.php" method="post">
				<div id="line">
					<input class="field" type="text" name="TheUserName" placeholder="User Name">
				</div>

				<div id="line">
					<input class="field" type="password" name="ThePassword" placeholder="Password">
				</div>
				
				<div id="line">
					<input class="button" type="submit" value="Login">
				</div>
		</form>
		<br>
		<div id="line">
			<img src="image.png" width="480" height="618" alt="No frogs allowed">
		</div>
	</body>
</html>
