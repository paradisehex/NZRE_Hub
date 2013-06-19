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
?>
