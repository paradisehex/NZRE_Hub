<?php	
	echo "<div id=\"MenuL\">";
	echo str_replace("\n" , "" , file_get_contents($_SESSION['path'].'/menu.txt', FILE_USE_INCLUDE_PATH));
	if($_SESSION['admin']){echo str_replace("\n" , "" , file_get_contents($_SESSION['path'].'/Admin/menu.txt', FILE_USE_INCLUDE_PATH));}
	if($_SESSION['view']!="Desktop"){
		echo "<div id=\"Item\"><a href=\"/Ingress\">Logout</a></div>";
	}else{
		echo "</div><div id=\"MenuR\">";
		echo "<div id=\"Item\"><a href=\"/Ingress\">";
		echo "<strong>Logout</strong> of <strong>".$_SESSION['name']." <div id=\"lvl".$_SESSION['lvl']."\" style=\"display:inline;\">".$_SESSION['lvl']."</div></strong></a></div>";
	}
	echo "</div><br><br>";
	



	echo "<div id=\"View\"><form class=\"footer\" action=\"/Ingress/Tools/setmobile.php\" method=\"post\">";
	echo "<input type=\"hidden\" name=\"URL\" value=\"".curPageURL()."\" >";
	if($_SESSION['view']=="Desktop"){
		echo "<input class=\"footer\" type=\"submit\" value=\"Mobile\" name=\"View\">";
	}else{
		echo "<input class=\"footer\" type=\"submit\" value=\"Desktop\" name=\"View\">";
	}
	echo "</form></div>";



	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
?>
