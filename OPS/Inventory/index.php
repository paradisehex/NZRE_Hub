<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		include $_SESSION['path']."/Tools/permission.php";
		include "display.php";


		$Name = strip_tags(stripslashes($_GET['Name']));

		
		$The_OP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
		
		if(!CanVeiwOP($TheOP['ID'], $_SESSION['name']) && $TheOP['Private']){
			$Name = null;
			return;
		}

		$EveryOne = selectFrom("AgentTable", null, null);
		
		$Total = 0;
		$Viewable = 0;
		
		$Names = array();
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
		<br><div id="Line">Select participants for <?php echo $Name;?></div><br>
			<?php
				while ($row = mysqli_fetch_array($EveryOne, MYSQL_ASSOC)) {
					if(0 < mysqli_num_rows(selectFrom("ParticipantTable", array("Name","ID"), array($row['username'],$The_OP['ID'])))){
						$Total += 1;
						if(CanVeiwOther($row['username'])){
							$Viewable += 1;
							$ItemString = "SELECT * FROM ItemTable WHERE username='".$row['username']."'";
							$ItemQuery = selectFrom("ItemTable", array("username"), array($row['username']));
							$Items = mysqli_fetch_array($ItemQuery, MYSQL_ASSOC);
							addInventory($Items);
							if($Items['year']!=0){$i++;}
							array_push($Names,$row['username']);
						}
					}
				}
				
				$EveryOne = selectFrom("AgentTable", null, null);
				while ($row = mysqli_fetch_array($EveryOne, MYSQL_ASSOC)) {
					if(0 < mysqli_num_rows(selectFrom("CoordinatorTable", array("Name","ID"), array($row['username'],$The_OP['ID'])))){
						$IsRepeat = false;
						foreach($Names as $A_Name){
							//echo "<br>".$A_Name." , ".$row['username'];
							if($A_Name == $row['username']){
								$IsRepeat = true;
							}
						}
						
						if( ! $IsRepeat ){
							$Total += 1;
							if(CanVeiwOther($row['username'])){
								$Viewable += 1;
								$ItemString = "SELECT * FROM ItemTable WHERE username='".$row['username']."'";
								$ItemQuery = selectFrom("ItemTable", array("username"), array($row['username']));
								$Items = mysqli_fetch_array($ItemQuery, MYSQL_ASSOC);
								addInventory($Items);
								if($Items['year']!=0){$i++;}
							}
						}
					}
				}
				
				echo "<div id=\"LineLow\">".$Viewable." out of ".$Total." players</div>";
				echoInv($Viewable);
			?>
	</body>
</html>
