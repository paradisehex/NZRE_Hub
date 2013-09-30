<?php
	session_start();
	include "/var/www/Ingress/Tools/database.php";
?>
<html>
	<?php include "/var/www/Ingress/Tools/head.php";?>
	<body>
		<?php include "/var/www/Ingress/Tools/menu.php";?>
		<p>
			<form action="update.php" method="post" autocomplete="off">
				Update Keys<br>
				<?php
					$Names = array();
					$result = mysqli_query($con,"SELECT * FROM PortalTable");
					while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
						array_push($Names,$row['PortalName']);
					}
				
					natcasesort ($Names);
				
					foreach($Names as $Name){
						$OldKeysQuerry = mysqli_query($con,"SELECT * FROM KeyTable WHERE username = '".$_SESSION['name']."' AND portalName = '".$Name."'");
						$OldKeysArray = mysqli_fetch_array($OldKeysQuerry);
						$OldKeys = $OldKeysArray['NumKeys'];	
						if($OldKeys==""){$OldKeys=0;}
						
						echo "<div id=\"lineTall\"><div id=\"Left\">".$Name."</div><div id=\"Right\">";
						echo "<input style=\"width:60px;\" class=\"fieldShort\" type=\"text\" name=\"".str_replace(" ","",$Name)."\" autocomplete=\"off\" value=\"".$OldKeys."\">";
						echo "</div></div>";
					}
				?>
				<br>
				<input class="button" type="submit" value="Update">
			</form>
		</p>
		<div id="line"><a href="../">Cancel</a></div>
	</body>
</html>
