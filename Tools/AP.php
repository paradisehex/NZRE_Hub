<?php
	$levels = array(
		0,
		0,
		2500,
		20000,
		70000,
		150000,
		300000,
		600000,
		1200000,
		2400000,
		4000000,
		6000000,
		8400000,
		12000000,
		17000000,
		24000000,
		40000000
	);
	
	function changeAp($ap){
		global $levels;
		
		$username = $_SESSION['name'];

		update("AgentTable", array("AP"), array($ap), "username", $username);
		
		$lvl = 1;
		
		$i = 0;
		while($i < sizeof($levels)){
			if($ap >= $levels[$i]){
				$lvl = $i;
			}
			$i++;
		}
		
		update("AgentTable", array("lvl"), array($lvl), "username", $username);
		$_SESSION['lvl'] = $lvl;
	}


	function echoCounter($lvl, $ap){
		global $levels;
		
		$fraction = floor(($ap - $levels[($lvl)] )/(( $levels[($lvl+1)] - $levels[($lvl)] )/8));
		if(($fraction<0)||($faction>7)){$fraction=0;}
		
		echo "<div id='case'>";
		echo "<div id='meter".$fraction."'>";
			echo "<div id='Counter'>".$lvl. "</div>";
		echo "</div></div>";
	}
?>
