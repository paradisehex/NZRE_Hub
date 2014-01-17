<?php

	function changeAp($ap){
		$username = $_SESSION['name'];

		update("AgentTable", array("AP"), array($ap), "username", $username);
		
		$lvl = 1;
		if($ap >= 2500){$lvl = 2;}
		if($ap >= 20000){$lvl = 3;}
		if($ap >= 70000){$lvl = 4;}
		if($ap >= 150000){$lvl = 5;}
		if($ap >= 300000){$lvl = 6;}
		if($ap >= 600000){$lvl = 7;}
		if($ap >= 1200000){$lvl = 8;}
		if($ap >= 2400000){$lvl = 9;}
		if($ap >= 4800000){$lvl = 10;}
		if($ap >= 9600000){$lvl = 11;}
		if($ap >= 19200000){$lvl = 12;}

		// Ap = 18750 * (lvl^2)
		
		
		//This is broken
		/*if($ap >= 150000){
			$lvl = 5;
			$lvlap = 150000;
			
			while($lvlap <= $ap){
				++$lvl;
				$lvlap = 18750 * $lvl * $lvl;
			}
			--$lvl;
		}*/
		
		
		update("AgentTable", array("lvl"), array($lvl), "username", $username);
		$_SESSION['lvl'] = $lvl;
	}
?>
