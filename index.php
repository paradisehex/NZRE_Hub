<?php
	session_start();
	session_destroy();
?>
<html>
	<head>
		<title>Login</title>
		<meta http-equiv="Content-Language" content="en"/>
		<link rel="stylesheet" type="text/css" href="/Ingress/style.css">
		<link rel="shortcut icon" href="/Ingress/icon.png" />
	</head>
	<body>
		<div id="line" >
			<div id="Title">
				Login
			</div>
		</div>
		<form name="LoginForm" action="checklogin.php" method="post">
				<div id="line">
					<input class="field" type="text" name="TheUserName" placeholder="User Name">
				</div>

				<div id="line">
					<input class="field" type="password" name="ThePassword" placeholder="Password">
				</div>

				<input class="button" type="submit" value="Login">
		</form><br>
		<div id="line">
			<img src="image.png" width="160" height="250" alt="No frogs allowed">
		</div>
	</body>
</html>
