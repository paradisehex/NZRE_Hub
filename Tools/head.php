<head>
	<title>Resistance</title>
	<meta http-equiv="Content-Language" content="en"/>
	<?php
		function CSS_link($FileName){
			return "<link rel=\"stylesheet\" type=\"text/css\" href=\"/Ingress/CSS/".$FileName.".css\">";
		}
		
		if($_SESSION['view']=="Desktop"){
			echo CSS_link("style");
			echo CSS_link("graph");
			echo CSS_link("menu");
			echo CSS_link("ap");
			echo CSS_link("button");
			echo CSS_link("ops");
		}else{
			echo CSS_link("Mobile/style");
		}
		
		echo CSS_link("colours");
	?>
	<link rel="shortcut icon" href="/Ingress/icon.png" />
</head>
