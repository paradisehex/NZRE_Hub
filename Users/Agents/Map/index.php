<?php
	session_start();
		include $_SESSION['path']."/Tools/database.php";
		
		$result = selectFrom("AgentTable", null, null);
?>
<html>
	<?php include $_SESSION['path']."/Tools/head.php";?>
	<body>
		<?php include $_SESSION['path']."/Tools/menu.php";?>
		<div id="line">Map of Trust</div>
		<p>
			<?php
				$NamesUsed = array();
				array_push($NamesUsed, $_SESSION['name']);
				
				$NamesOnRow = array();
				array_push($NamesOnRow, $_SESSION['name']);
				
				$NamesOnNextRow = array();
				
				$Finished = false;
				
				$i = 0;
				while(!$Finished){
					echo "<div id=\"line\"><div id=\"left\">".$i++."</div>";
					$First = true;
						foreach($NamesOnRow as $Name){
							if(!$First){
								echo "<div style=\"width: 20px; display: inline-block;\"></div>";
							}else{
								$First = false;
							}
							echo "<a class=\"Agent\" style=\"display: inline;\" href=\"/Ingress/Users/Inventory/?Name=".$Name."\">".$Name."</a>";
						
						
							//Add Names to next row
							$Result = selectFrom("VerifyTable", array("Truster"), array($Name));
							while ($Agent = mysqli_fetch_array($Result, MYSQL_ASSOC)) {
								$IsUsed = false;
								foreach($NamesUsed as $UsedName){
									if($UsedName == $Agent['Trustee']){
										$IsUsed = true;
									}
								}
								if(!$IsUsed){
									array_push($NamesUsed, $Agent['Trustee']);
									array_push($NamesOnNextRow, $Agent['Trustee']);
								}
							}
					
						}
					echo "</div><br><br>";
					
					$NamesOnRow = $NamesOnNextRow;
					$NamesOnNextRow = array();
					
					$Finished = true;
					foreach($NamesOnRow as $Name){$Finished = false;}
				}
				
				//Echo all the other agents
				echo "<div id=\"line\"><div id=\"left\">Not Trusted</div>";
					$Result = selectFrom("AgentTable", array(), array());
					
					$First = true;
					while ($Agent = mysqli_fetch_array($Result, MYSQL_ASSOC)) {
						if(!$First){
							echo "<div style=\"width: 20px; display: inline-block;\"></div>";
						}else{
							$First = false;
						}
						
						$IsUsed = false;
						foreach($NamesUsed as $UsedName){
							if($UsedName == $Agent['username']){
								$IsUsed = true;
							}
						}
						if(!$IsUsed){
							echo "<a class=\"Agent\" style=\"display: inline;\" href=\"/Ingress/Users/Inventory/?Name=".$Agent['username']."\">".$Agent['username']."</a>";
						}
					}
				echo "</div>";
			?>
		</p>
	</body>
</html>
