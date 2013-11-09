<?php
	function CanVeiwOther($con,$OtherName){
		$ResultPlayer = selectFrom("AgentTable",array("username"), array($_SESSION['name']));
		$Player = mysqli_fetch_array($ResultPlayer, MYSQL_ASSOC);

		$OtherQuery = selectFrom("AgentTable",array("username"), array($OtherName));
		$Other = mysqli_fetch_array($OtherQuery);

		if($Player['Location']==$Other['Location']){
			if($Player['lvl']>=$Other['InLvl']){return true;}else{return false;}
		}else{
			if($Player['lvl']>=$Other['outLvl']){return true;}else{return false;}
		}
	}



	function OfficerAndLocation($con,$Name,$LocationName){
		if($_SESSION['admin']){return true;}
		$Locations = selectFrom("LocationTable",array("name"), array($LocationName));
		$Location =mysqli_fetch_array($Locations, MYSQL_ASSOC);

		$Officer = selectFrom("OfficerTable", array("username", "Location"), array($Name, $Location['id']));

		if(0<mysqli_num_rows($Officer)){
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
?>
