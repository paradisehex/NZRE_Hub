<?php
	function errorMsg($Msg, $Page){
		echo "<html>";
			include $_SESSION['path']."/Tools/head.php";
			echo "<body>";
				include $_SESSION['path']."/Tools/menu.php";
				
				echo "<div id=\"Line\" style=\"color:#FF0000;text-shadow: 0 0 5px; font-weight:bold;\">";
					echo "ERROR";
				echo "</div>";
				
				echo "<br>";
				
				echo "<div id=\"Line\">";
					echo $Msg;
				echo "</div>";
				
				if($Page != ""){
					echo "<br>";
					echo "<div id=\"Line\">";
						echo "<a href=\"".$Page."\">Back</a>";
					echo "</div>";
				}
				
			echo "</body>";
		echo "</html>";
	}
?>
