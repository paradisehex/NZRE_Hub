<?php 
	function isPlused($Name){
		$Count = mysqli_num_rows(selectFrom("VerifyTable", array("Truster", "Trustee"), array($_SESSION['name'], $Name)));
		return ($Count == 1);
	}

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
						echo "<div style=\"width: 500px;\" id=\"Line\">";
							echo "<div id=\"Left\">";
								echo $count;
							
								echo "<a class=\"Agent\" href=\"/Ingress/Users/Inventory/?Name=".$row['username']."\">";
									echo $row['username'];
								echo "</a>";
							
								echo "<form style=\"display: inline;\" action=\"/Ingress/Users/Agents/plusOne.php\" method=\"post\">";
									$Class = isPlused($row['username']) ? "minusOne" : "plusOne";
									if($row['username'] == $_SESSION['name']){$Class = "Hide";}
									echo "<input class=\"".$Class."\" type=\"submit\" value=\"+1\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
								echo "</form>";
								
							echo "</div>";
							echo "<div id=\"Right\">";
								echo "<div style=\"display: inline;\" id=\"lvl".$row['lvl']."\">".$ap." AP</div>";
							echo "</div>";
						echo "</div>";
						echo "<br>";
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
						echo "<div style=\"width: 500px;\" id=\"Line\">";
							echo "<div id=\"Left\">";
								echo "<lu style=\"color:#000000; text-shadow: none;\">0</lu>";
							
								echo "<a class=\"Agent\" href=\"/Ingress/Users/Inventory/?Name=".$row['username']."\">";
									echo $row['username'];
								echo "</a>";
								
								echo "<form style=\"display: inline;\" action=\"/Ingress/Users/Agents/plusOne.php\" method=\"post\">";
									$Class = isPlused($row['username']) ? "minusOne" : "plusOne";
									if($row['username'] == $_SESSION['name']){$Class = "Hide";}
									echo "<input class=\"".$Class."\" type=\"submit\" value=\"+1\"><input type=\"hidden\" name=\"Name\" value=\"".$row['username']."\">";
								echo "</form>";
								
							echo "</div>";
						echo "</div>";
						echo "<br>";
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
