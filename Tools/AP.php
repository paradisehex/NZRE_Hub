<?php
	function echoCounter($lvl,$ap){
		$fraction = 0;
		if($lvl>=5){
			$LvlAp = 150000*(pow(2,$lvl-5));
			$fraction = floor(($ap-$LvlAp)/((150000*(pow(2,$lvl-4))-$LvlAp)/8));
		}else{
			$levels = array(0,0,10000,30000,70000,150000);
			$fraction = floor(($ap - $levels[($lvl)] )/(( $levels[($lvl+1)] - $levels[($lvl)] )/8));
		}
		if(($fraction<0)||($faction>7)){
			$fraction=0;
		}
		echo "<div id=\"case\">";
		echo "<div id=\"meter".$fraction."\">";
			echo "<div id=\"Counter\">".$lvl. "</div>";
			echo "<div id=\"AP\">".$ap." AP</div>";
		echo "</div></div>";
	}
?>
