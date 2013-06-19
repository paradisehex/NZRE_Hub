<?php		
	echo "<div id=\"MenuL\">";
	echo file_get_contents('/var/www/Ingress/menu.txt', FILE_USE_INCLUDE_PATH);
	if($_SESSION['admin']){echo file_get_contents('/var/www/Ingress/Admin/menu.txt', FILE_USE_INCLUDE_PATH);}
	echo "</div><div id=\"MenuR\"><div id=\"Item\">";
	echo "<a href=\"/Ingress\"><strong>Logout</strong> of <strong>".$_SESSION['name']." <div id=\"lvl".$_SESSION['lvl']."\" style=\"display:inline;\">".$_SESSION['lvl']."</div></strong></a>";
	echo "</div></div><br><br>";
?>
