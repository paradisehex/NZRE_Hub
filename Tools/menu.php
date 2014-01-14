<?php	
	echo "<div id=\"MenuL\">";
	$MenuNames = array("Agents","Areas","Portals","Info","Settings");
	$MenuLinks = array("Agents/List","Areas","Portals","Info","Settings");
	
	$SplitURL = explode("/",  $_SERVER["REQUEST_URI"]);
	$URL_Length = count($SplitURL);
	
	$length = count($MenuNames);
	for ($i = 0; $i < $length; $i++) {

		echo "<div id=\"Item\"><a ";
		
		if($SplitURL[2] == $MenuNames[$i]){
			echo "class=\"active\"";
		}
		echo "href=\"/Ingress/".$MenuLinks[$i]."\">".$MenuNames[$i]."</a></div>";
	}
	
	if($_SESSION['admin']){
		echo "<div id=\"Item\"><a ";
		
		if($SplitURL[2] == "Admin"){
			echo "class=\"active\"";
		}
		echo "href=\"/Ingress/Admin\">Admin</a></div>";
	}
	
	
	if($_SESSION['view']!="Desktop"){
		echo "<div id=\"Item\"><a href=\"/Ingress\">Logout</a></div>";
	}else{
		echo "</div><div id=\"MenuR\">";
		echo "<div id=\"Item\"><a href=\"/Ingress\">";
		echo "Logout ".$_SESSION['name']." <div id=\"lvl".$_SESSION['lvl']."\" style=\"display:inline;\">".$_SESSION['lvl']."</div></a></div>";
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
		if (isset( $_SERVER["HTTPS"] ) && (strtolower( $_SERVER["HTTPS"] ) == "on")) {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
?>
