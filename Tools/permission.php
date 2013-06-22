<?php
	function CanVeiwOther($con,$OtherName){
		$ResultPlayer=mysqli_query($con,"SELECT * FROM AgentTable WHERE username = \"".$_SESSION['name']."\"");
		$Player = mysqli_fetch_array($ResultPlayer, MYSQL_ASSOC);

		$OtherString = "SELECT * FROM AgentTable WHERE username = '".$OtherName."'";
		$OtherQuery = mysqli_query($con,$OtherString);
		$Other = mysqli_fetch_array($OtherQuery);

		if($Player['Location']==$Other['Location']){
			if($Player['lvl']>=$Other['InLvl']){return true;}else{return false;}
		}else{
			if($Player['lvl']>=$Other['outLvl']){return true;}else{return false;}
		}
	}



	function OfficerAndLocation($con,$Name,$LocationName){
		if($_SESSION['admin']){return true;}
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
		if($_SESSION['admin']){return true;}
		$result = mysqli_query($con,"SELECT * FROM LocationTable WHERE name='".$LocationName."'");

		$Location =mysqli_fetch_array($result);

		if($Location['admin']==$Name){
			return true;
		}
		return false;
	}

	function IsOfficer($con,$Name){
		if($_SESSION['admin']){return true;}
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
