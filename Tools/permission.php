<?php
	function CanVeiwOther($con,$OthersLocationID,$OthersLevel){
		$ResultPlayer=mysqli_query($con,"SELECT * FROM AgentTable WHERE username = \"".$_SESSION['name']."\"");
		$PlayersRow = mysqli_fetch_array($ResultPlayer, MYSQL_ASSOC);


		if(($_SESSION['lvl']>=7)|($_SESSION['admin'])){
			return true;
		}else{
			if(($OthersLevel<=$_SESSION['lvl'])&($PlayersRow['Location']==$OthersLocationID)){
				return true;
			}else{
				return false;
			}
		}
	}



	function OfficerAndLocation($con,$Name,$LocationName){
		$Locations = mysqli_query($con,"SELECT * FROM LocationTable WHERE name='".$LocationName."'");
		$Location =mysqli_fetch_array($Locations, MYSQL_ASSOC);

		$OfficerQuery="SELECT * FROM OfficerTable WHERE username='".$Name."' AND Location='".$Location['id']."'";
		$Officer = mysqli_query($con,$OfficerQuery);

		if(0<mysqli_num_rows($Officer)){
			return true;
		}else{
			if($Location['admin']==$Name){return true;}
			return false;
		}
	}


	function CaptainAndLocation($con,$Name,$LocationName){
		$result = mysqli_query($con,"SELECT * FROM LocationTable WHERE name='".$LocationName."'");

		$Location =mysqli_fetch_array($result);

		if($Location['admin']==$Name){
			return true;
		}
		return false;
	}

	function IsOfficer($con,$Name){
		$Location = mysqli_query($con,"SELECT * FROM LocationTable WHERE admin='".$Name."'");

		$OfficerQuery="SELECT * FROM OfficerTable WHERE username='".$Name."'";
		$Officer = mysqli_query($con,$OfficerQuery);

		if(0<mysqli_num_rows($Officer)){
			return true;
		}else{
			if(0<mysqli_num_rows($Location)){return true;}
			return false;
		}
	}
?>
