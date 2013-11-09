<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";

		$name = strip_tags($_GET['Name']);

		$result= selectFrom("LocationTable", array("name"), array($name));
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);

		$ID = $row['id'];

		$InLocation = selectFrom("AgentTable", array("Location"), array($row['id']));

		$sql="SELECT * FROM AgentTable";
		$EveryOne =mysqli_query($con,$sql);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<br>
		<div id="line">
			<?php
				echo "<a href=\"/Ingress/Areas/Info/?Name=".$name."\">Back</a>";
			?>
		</div>
		<div id="Line">Select</div>
			<?php
				echo "<form action=\"change.php\" method=\"post\">";
				while ($row = mysqli_fetch_array($InLocation, MYSQL_ASSOC)) {
					if(0<mysqli_num_rows(selectFrom("OfficerTable", array("username"), array($row['username'])))){	
						echo "<input class=\"buttonOfficer\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
					}else{
						echo "<input class=\"button\" type=\"submit\" name=\"Name\" value=\"".$row['username']."\" >";
					}
				}
				echo "<input type=\"hidden\" name=\"ID\" value=\"".$ID."\">";
				echo "<input type=\"hidden\" name=\"Location\" value=\"".$name."\">";
				echo "</form>";
			?>
	</body>
</html>
