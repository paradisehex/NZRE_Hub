<?php
	function echoInv($row,$Extra){
		$ItemCount = 0;
		$boo = false;

		$Res = 0;
		$Xmp = 0;
		$other = 0;

		function itemLine($Num,$ID,$Des){
			if($Num!=0){
				echo "<div id=\"LineLow\"><div id=\"Left\">".$Des."</div><div id=\"Right\"><div id=\"".$ID."\">".$Num."</div></div></div>";
				return true;
			}
		}

		//Res
		for ($i = 1; $i <= 8; $i++) {
			$boo = itemLine($row['R'.$i],"lvl$i","Level $i Resonators");
			$ItemCount+=$row['R'.$i];
			$Res+=$row['R'.$i];
		}
		if($boo){echo "<br>";$boo = false;}


		//Xmps
		for ($i = 1; $i <= 8; $i++) {
			$boo = itemLine($row['X'.$i],"lvl$i","Level $i Xmp Bursters");
			$ItemCount+=$row['X'.$i];
			$Xmp+=$row['X'.$i];
		}
		if($boo){echo "<br>";$boo = false;}


		//Viruses
		$boo = itemLine($row['VJ'],"Jarvis","Jarvis Virus");
		$boo = itemLine($row['VA'],"Ada","ADA Refactor");
		if($boo){echo "<br>";$boo = false;}


		//Sheilds
		$boo = itemLine($row['S1'],"Com","Common Shields");
		$boo = itemLine($row['S2'],"Rar","Rare Shields");
		$boo = itemLine($row['S3'],"Ver","Very Rare Shields");
		if($boo){echo "<br>";$boo = false;}


		//Mods
		$boo = itemLine($row['MA'],"Rar","Link Amp");
		$boo = itemLine($row['MH'],"Com","Heat Sin");
		$boo = itemLine($row['MM'],"Rar","Multi-hack");
		$boo = itemLine($row['MF'],"Rar","Force Amp");
		$boo = itemLine($row['MT'],"Rar","Turret");
		if($boo){echo "<br>";$boo = false;}


		//Power Cubes
		for ($i = 1; $i <= 8; $i++) {
			$boo = itemLine($row['P'.$i],"lvl$i","Level $i Power Cubes");
			$ItemCount+=$row['P'.$i];
			$other+=$row['P'.$i];
		}
		if($boo){echo "<br>";$boo = false;}


		//Keys
		itemLine($row['K1'],"Ke","Keys");


		//Items
		$ItemCount+=$row['VA']+$row['VJ']+$row['S1']+$row['S2']+$row['S3']+$row['K1'];
		$other+=$row['VA']+$row['VJ']+$row['S1']+$row['S2']+$row['S3']+$row['MA']+$row['MH']+$row['MM']+$row['MF']+$row['MT'];
		if($ItemCount!=0){
			echo "<div id=\"LineLow\">Total ".$ItemCount."</div>";
		}else{
			echo "<div id=\"LineLow\">No inventory data</div>";
		}
		
		echo $Extra;

		//Graph
		$OneP = 20;
		echo "<div id=\"Bar\">";
		echo "<div id=\"RES\" style=\"width:".($Res/$OneP)."%;\"></div>";
		echo "<div id=\"XMP\" style=\"width:".($Xmp/$OneP)."%;\"></div>";
		echo "<div id=\"KEYS\" style=\"width:".($row['K1']/$OneP)."%;\"></div>";
		echo "<div id=\"OTH\" style=\"width:".($other/$OneP)."%;\"></div>";
		echo "<div id=\"EMP\" style=\"width:".((2000-$other-$row['K1']-$Xmp-$Res)/$OneP)."%;\"></div>";
		echo "<div id=\"Key\"><div id=\"R\">Resonators</div><div id=\"X\">Xmps</div><div id=\"K\">Keys</div><div id=\"O\">Other</div></div>";
		echo "</div>";
	}
?>
