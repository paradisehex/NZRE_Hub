<?php
	function CanVeiwOther($OtherName){
		$OtherQuery = selectFrom("AgentTable",array("username"), array($OtherName));
		$Other = mysqli_fetch_array($OtherQuery);

		if(getDegree($OtherName, $_SESSION['name']) <= $Other['ViewDegree']){return true;}else{return false;}
	}



	function OfficerAndLocation($con,$Name,$LocationName){
		if($_SESSION['admin']){return true;}
		$Locations = selectFrom("LocationTable",array("name"), array($LocationName));
		$Location = mysqli_fetch_array($Locations, MYSQL_ASSOC);

		$Officer = selectFrom("OfficerTable", array("username", "Location"), array($Name, $Location['id']));

		if(0 < mysqli_num_rows($Officer)){
			return true;
		}else{
			if($Location['admin']==$Name){return true;}
			return false;
		}
	}



	function CaptainAndLocation($con,$Name,$LocationName){
		if($_SESSION['admin']){return true;}
		$result = selectFrom("LocationTable",array("name"), array($LocationName));

		$Location =mysqli_fetch_array($result);

		if($Location['admin']==$Name){
			return true;
		}
		return false;
	}

	function IsOfficer($con,$Name){
		if($_SESSION['admin']){return true;}
		$Location = selectFrom("LocationTable",array("admin"), array($Name));

		$OfficerQuery="SELECT * FROM OfficerTable WHERE username='".$Name."'";
		$Officer = mysqli_query($con,$OfficerQuery);

		if(0<mysqli_num_rows($Officer)){
			return true;
		}else{
			if(0<mysqli_num_rows($Location)){return true;}
			return false;
		}
	}
	
	
	
	function getDegree($Name, $OtherName){
		$NamesUsed = array();
		array_push($NamesUsed, $Name);
		
		$NamesOnRow = array();
		array_push($NamesOnRow, $Name);
				
		$NamesOnNextRow = array();
		
		$Finished = false;
		
		$i = 0;
		while(!$Finished){
			foreach($NamesOnRow as $Name){
				if($Name == $OtherName){
					return $i;
				}
				
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
			
			$NamesOnRow = $NamesOnNextRow;
			$NamesOnNextRow = array();
			
			$i++;
			
			$Finished = true;
			foreach($NamesOnRow as $Name){$Finished = false;}
		}
		
		return 99999;
	}
	
	
	
	function IsCoordintor($OP_ID, $Name){
		if($_SESSION['admin']){return true;}
		
		$Coordinators = selectFrom("CoordinatorTable", array("ID"), array($OP_ID));
		
		while ($Coordinator = mysqli_fetch_array($Coordinators, MYSQL_ASSOC)) {
			if($Coordinator['Name'] == $Name){
				return true;
			}
		}
		return false;
	}
	
	function CanVeiwOP($OP_ID, $Name){
		if($_SESSION['admin']){return true;}
		
		$Coordinators = selectFrom("CoordinatorTable", array("ID"), array($OP_ID));
		
		while ($Coordinator = mysqli_fetch_array($Coordinators, MYSQL_ASSOC)) {
			if($Coordinator['Name'] == $Name){
				return true;
			}
		}
			
		$Participants = selectFrom("ParticipantTable", array("ID"), array($OP_ID));
		
		while ($Participant = mysqli_fetch_array($Participants, MYSQL_ASSOC)) {
			if($Participant['Name'] == $Name){
				return true;
			}
		}
		
		return false;
	}
	
	function canEditComment($CommentName, $OP_ID){
		if($CommentName == $_SESSION['name'] || $_SESSION['admin']){
			return true;
		}
		
		
		$Coordinators = selectFrom("CoordinatorTable", array("ID"), array($OP_ID));
		
		while ($Coordinator = mysqli_fetch_array($Coordinators, MYSQL_ASSOC)) {
			if($Coordinator['Name'] == $_SESSION['name']){
				return true;
			}
		}
	}
?>
