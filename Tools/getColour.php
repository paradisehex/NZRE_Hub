<?php
	function getLvlColour($Lvl){
		switch ($Lvl){
			case 1:
				return "#fece5a";
			case 2:
				return "#ffa630";
			case 3:
				return "#ff7315";
			case 4:
				return "#e40000";
			case 5:
				return "#fd2992";
			case 6:
				return "#eb26cd";
			case 7:
				return "#c124e0";
			case 8:
				return "#9627f4";
		}
	}
	
	function getRarityColour($Lvl){
		switch ($Lvl){
			case 1:
				return "#8dffc3";
			case 2:
				return "#ab8afd";
			case 3:
				return "#fe8bf5";
			case 4:
				return "#ffcc00";
			default:
				return "#00C2FF";
		}
	}
?>
