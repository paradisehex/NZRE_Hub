<?php
	session_start();
	
	include $_SESSION['path']."/Tools/database.php";
	include $_SESSION['path']."/Tools/permission.php";
	include $_SESSION['path']."/Tools/bb.php";
	
	$Name = strip_tags(stripslashes($_GET['Name']));
	if($Name != null){
		$TheOP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
		$Comments = selectFrom("CommentsTable", array("OP_ID"), array($TheOP['ID']));
		
		if(!CanVeiwOP($TheOP['ID'], $_SESSION['name']) && $TheOP['Private']){
			$Name = null;
		}
	}
	
	
	function Agent_Link($a_Name){
		return "<div id=\"Right\"><a class=\"Agent\" style=\"display: inline;\" href=\"/Ingress/Agents/?Name=".$a_Name."\">".$a_Name."</a></div>";
	}
	function canEdit($Comment){
		if(canEditComment($Comment['Name'], $TheOP['ID'])){
			return " <a class='Agent' style='width: initial;' href='./Comment/?ID=".$Comment['ID']."'>edit</a> ";
		}
	}
	
	function Portal_Link($a_Name){
		return "<div id=\"Right\"><a class=\"Agent\" style=\"display: inline;\" href=\"/Ingress/Portals/Info/?Name=".$a_Name."\">".$a_Name."</a></div>";
	}
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<p>
			
			<?php
			/*
				No OP selected
			*/
				if($Name == null){
					echo "<div id=\"line\">Operations</div>";
					echo "<p>";
						echo "<div id=\"line\"><a href=\"Intialize\">Intialize an OP</a></div><br>";
						
						
					//Private
						$Names = array();
						$result = selectFrom("OPSTable", array("Private"), array(true));
						while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
							if(!$row['Archived']){
								array_push($Names,$row['Name']);
							}
						}
				
						natcasesort ($Names);
						$First = true;
						foreach($Names as $Name){
							
							$AnOP = mysqli_fetch_array(selectFrom("OPSTable", array("Name"), array($Name)));
							if(CanVeiwOP($AnOP['ID'], $_SESSION['name'])){
								if($First){echo "<div id=\"Line\">Private OPS</div>";$First = false;}
								echo "<div id=\"Line\"><a href=\"./?Name=".$Name."\">".$Name."</a></div>";
							}
						}
						
					//Public
						$Names = array();
						$result = selectFrom("OPSTable", array("Private"), array(false));
						while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
							if(!$row['Archived']){
								array_push($Names,$row['Name']);
							}
						}
				
						natcasesort ($Names);
				
						$First = true;
						foreach($Names as $Name){
							if($First){echo "<br><div id=\"Line\">Public OPS</div>";$First = false;}
							echo "<div id=\"Line\"><a href=\"./?Name=".$Name."\">".$Name."</a></div>";
						}
						
					//Archived
						$Names = array();
						$result = selectFrom("OPSTable", array("Archived"), array(true));
						while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
							array_push($Names, $row['Name']);
						}
				
						natcasesort ($Names);
				
						$First = true;
						foreach($Names as $Name){
							if($First){echo "<br><div id=\"Line\">Archived OPS</div>";$First = false;}
							echo "<div id=\"Line\"><a href=\"./?Name=".$Name."\">".$Name."</a></div>";
						}
					echo "</p>";
				}
				
			/*
				OP selected
			*/
				else{
					if(!$TheOP['Archived']){
						echo "<div id=\"line\">Operation <strong>".$Name."</strong></div><p>";
					
					
						echo "<div id=\"whiteSpaceWide\">";
							echo format_comment($TheOP['Description']);
						echo "</div><br>";
					
					
						$First = true;
						$Coordinators = selectFrom("CoordinatorTable", array("ID"), array($TheOP['ID']));
						while ($Coordinator = mysqli_fetch_array($Coordinators, MYSQL_ASSOC)) {
							if($First){
								echo "<div id=\"LineWideTall\" style=\"width: 500px;\"><div id=\"Left\"><b>Coordinators:</b></div>".Agent_Link($Coordinator['Name'])."</div>";
								$First = false;
							}else{
								echo "<div id=\"LineWideTall\" style=\"width: 500px;\">".Agent_Link($Coordinator['Name'])."</div>";
							}
						}
						
						if($TheOP['Private']){
							$First = true;
							$Participants = selectFrom("ParticipantTable", array("ID"), array($TheOP['ID']));	
							while ($Participant = mysqli_fetch_array($Participants, MYSQL_ASSOC)) {
								if($First){
									echo "<br><div id=\"LineWideTall\" style=\"width: 500px;\"><div id=\"Left\"><b>Participants:</b></div>".Agent_Link($Participant['Name'])."</div>";
									$First = false;
								}else{
									echo "<div id=\"LineWideTall\" style=\"width: 500px;\">".Agent_Link($Participant['Name'])."</div>";
								}
							}
						}
						
						$First = true;
						$Portals = selectFrom("PortalOPTable", array("OP_ID"), array($TheOP['ID']));
						while ($Portal = mysqli_fetch_array($Portals, MYSQL_ASSOC)) {
							if($First){
								echo "<br><div id=\"LineWideTall\" style=\"width: 500px;\"><div id=\"Left\"><b>Portals:</b></div>".Portal_Link($Portal['PortalName'])."</div>";
								$First = false;
							}else{
								echo "<div id=\"LineWideTall\" style=\"width: 500px;\">".Portal_Link($Portal['PortalName'])."</div>";
							}
						}
					
					
						if(IsCoordintor($TheOP['ID'], $_SESSION['name'])){
							echo "<div id=\"Line\"><a href=\"./Edit/?Name=".$Name."\">Edit</a></div>";
							echo "<div id=\"Line\"><a href=\"./Delete/?Name=".$Name."\">Delete</a></div>";
							echo "<div id=\"Line\"><a href=\"./Coordinators/?Name=".$Name."\">Coordinators</a></div>";
							echo "<div id=\"Line\"><a href=\"./Archive/?Name=".$Name."\">Archive</a></div>";
							echo "<div id=\"Line\"><a href=\"./Rename/?Name=".$Name."\">Rename</a></div>";
							echo "<div id=\"Line\"><a href=\"./Portals/?Name=".$Name."\">Portals</a></div>";
							if($TheOP['Private']){	
								echo "<div id=\"Line\"><a href=\"./Participants/?Name=".$Name."\">Participants</a></div>";
							}
						}
					
						echo "<br>Coments";
					
					
						echo	"<div style=\"width: 500px; margin:0 auto;\">";
						while ($Comment = mysqli_fetch_array($Comments, MYSQL_ASSOC)) {
								echo "<div id='Left'><strong>".Agent_Link($Comment['Name'])."</strong></div>";
								echo "<div id='Right'>".canEdit($Comment).date("H:i j/n/y", $Comment['Time'])."</div>";
								echo "<div id='Left' style='margin-bottom: 20px;'><div id='whiteSpaceWide'>".format_comment($Comment['Msg'])."</div></div><br>";
						}
						echo "</div>";
						
						echo "<form  class=\"wide\" action=\"comment.php\" method=\"post\">";
							echo "<textarea class=\"R\" name=\"Message\" style=\"height:60px;\"></textarea>";
							echo "<input type=\"hidden\" name=\"Name\" value=\"".$Name."\">";
							echo "<input class=\"button\" type=\"submit\" value=\"Post\" style=\"float:right;width:100px;\">";
						echo "</form>";
					}else{
					
					
			/*
				OP archived
			*/	
						echo "<div id=\"line\">Operation <strong>".$Name."</strong></div><p>";
					
					
						echo "<div id=\"whiteSpaceWide\">";
							echo format_comment($TheOP['Description']);
						echo "</div><br>";
					
					
						$First = true;
						$Coordinators = selectFrom("CoordinatorTable", array("ID"), array($TheOP['ID']));
						while ($Coordinator = mysqli_fetch_array($Coordinators, MYSQL_ASSOC)) {
							if($First){
								echo "<div id=\"LineWideTall\" style=\"width: 500px;\"><div id=\"Left\"><b>Coordinators:</b></div>".Agent_Link($Coordinator['Name'])."</div>";
								$First = false;
							}else{
								echo "<div id=\"LineWideTall\" style=\"width: 500px;\">".Agent_Link($Coordinator['Name'])."</div>";
							}
						}
						if($TheOP['Private']){
							$First = true;
							$Participants = selectFrom("ParticipantTable", array("ID"), array($TheOP['ID']));	
							while ($Participant = mysqli_fetch_array($Participants, MYSQL_ASSOC)) {
								if($First){
									echo "<br><div id=\"LineWideTall\" style=\"width: 500px;\"><div id=\"Left\"><b>Participants:</b></div>".Agent_Link($Participant['Name'])."</div>";
									$First = false;
								}else{
									echo "<div id=\"LineWideTall\" style=\"width: 500px;\">".Agent_Link($Participant['Name'])."</div>";
								}
							}
						}
						
						$First = true;
						$Portals = selectFrom("PortalOPTable", array("OP_ID"), array($TheOP['ID']));
						while ($Portal = mysqli_fetch_array($Portals, MYSQL_ASSOC)) {
							if($First){
								echo "<br><div id=\"LineWideTall\" style=\"width: 500px;\"><div id=\"Left\"><b>Portals:</b></div>".Portal_Link($Portal['PortalName'])."</div>";
								$First = false;
							}else{
								echo "<div id=\"LineWideTall\" style=\"width: 500px;\">".Portal_Link($Portal['PortalName'])."</div>";
							}
						}
					
					
						if(IsCoordintor($TheOP['ID'], $_SESSION['name'])){
							echo "<div id=\"Line\"><a href=\"./Delete/?Name=".$Name."\">Delete</a></div>";
							echo "<div id=\"Line\"><a href=\"./unarchive.php/?Name=".$Name."\">Unarchive</a></div>";
						}
					
						echo "<br>Coments";
					
					
						echo	"<div style=\"width: 500px; margin:0 auto;\">";
						while ($Comment = mysqli_fetch_array($Comments, MYSQL_ASSOC)) {
								echo "<div id='Left'><strong>".Agent_Link($Comment['Name'])."</strong></div>";
								echo "<div id='Right'>".date("H:i j/n/y", $Comment['Time'])."</div>";
								echo "<div id='Left' style='margin-bottom: 20px;'><div id='whiteSpaceWide'>".format_comment($Comment['Msg'])."</div></div><br>";
						}
						echo "</div>";
					}
				}
			?>
	</body>
</html>
