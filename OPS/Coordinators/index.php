<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$Name = strip_tags(stripslashes($_GET['Name']));

		
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));

		$EveryOne = selectFrom("AgentTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<br>
		<div id="line">
			<?php
				echo "<a href=\"/Ingress/OPS/?Name=".$Name."\">Back</a>";
			?>
		</div>
		<br><div id="Line">Select coordinators for <?php echo $Name;?></div><br>
			<?php
				echo "<form action=\"change.php\" method=\"post\">";
					while ($row = mysqli_fetch_array($EveryOne, MYSQL_ASSOC)) {
						if(0 < mysqli_num_rows(selectFrom("CoordinatorTable", array("Name","ID"), array($row['username'],$The_OP['ID'])))){	
							echo "<input class=\"buttonOfficer\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
						}else{
							echo "<input class=\"button\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
						}
					}
					echo "<input type=\"hidden\" name=\"ID\" value=\"".$The_OP['ID']."\">";
				echo "</form>";
			?>
	</body>
</html>
