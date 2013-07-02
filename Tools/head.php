<?php
	echo "<head>";	
	echo "<title>Resistance</title>";
	echo "<meta http-equiv=\"Content-Language\" content=\"en\"/>";
	if($_SESSION['view']=="Desktop"){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/Ingress/Users/style.css\">";
	}else{
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/Ingress/Users/mobile.css\">";
	}
	echo "<link rel=\"shortcut icon\" href=\"/Ingress/icon.png\" />";
	echo "</head>";
?>
