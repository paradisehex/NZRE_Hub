<?php 
	function echoAgentsRanking($result,$con){
		$AP = array();
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			array_push($AP,$row['AP']);
		}
		rsort($AP);
		
		$count = 1;
		$lastAP = -1;
		$ap = -1;
		foreach($AP as $i){
			$result = selectFrom("AgentTable", array("AP"), array($i));
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				if($lastAP != $row['AP']){
					if($row['AP']){
						$ap = $row['AP'];
						echo "<div id=\"Line\">";
						echo "<div id=\"Left\">";
							echo "<a href=\"/Ingress/Users/Inventory/?Name=".$row['username']."\"><div id=\"Left\" style=\"padding-left:2px;\">".$count."</div>".$row['username']."</a>";
						echo "</div><div id=\"Right\">";
								echo "<div id=\"lvl".$row['lvl']."\">".$ap." AP</div>";
						echo "</div></div>";
						$count++;
					}
				}
			}
			$lastAP = $ap;
		}
		foreach($AP as $i){
			$result = selectFrom("AgentTable", array("AP"), array($i));
			
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				if($lastAP != $row['AP']){
					if(!$row['AP']){
						$ap = $row['AP'];
						echo "<div id=\"Line\"><div id=\"left\">";
							echo "<a href=\"/Ingress/Users/Inventory/?Name=".$row['username']."\">".$row['username']."</a>";
						echo "</div></div>";
						$count++;
					}
				}
			}
			$lastAP = $ap;
		}
	}

	function echoAgentsLocation($result,$con,$L){
		$IsAgents = false;

		$AP = array();
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			array_push($AP,$row['AP']);
		}
		rsort($AP);
		
		$count = 1;
		$lastAP = -1;
		$ap = -1;
		foreach($AP as $i){
			$result = selectFrom("AgentTable", array("AP","Location"), array($i,$L));
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				if($lastAP != $row['AP']){
					$ap = $row['AP'];
					echo "<div id=\"Line\">";
						echo "<a href=\"/Ingress/Users/Inventory/?Name=".$row['username']."\">";
							echo "<div id=\"Left\"><div id=\"lvl".$row['lvl']."\" style=\"padding-left:2px;\">".$row['lvl']."</div></div>".$row['username'];
						echo "</a>";
					echo "</div>";
					$count++;
					$IsAgents = true;
				}
			}
			$lastAP = $ap;
		}
		return $IsAgents;
	}
?>
