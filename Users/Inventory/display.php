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
			return $boo;
		}

		//Res
		for ($i = 1; $i <= 8; $i++) {
			if(itemLine($row['R'.$i],"lvl$i","Level $i Resonators")){$boo = true;}
			$ItemCount+=$row['R'.$i];
			$Res+=$row['R'.$i];
		}
		if($boo){echo "<br>";$boo = false;}


		//Xmps
		for ($i = 1; $i <= 8; $i++) {
			if(itemLine($row['X'.$i],"lvl$i","Level $i Xmp Bursters")){$boo = true;}
			$ItemCount+=$row['X'.$i];
			$Xmp+=$row['X'.$i];
		}
		if($boo){echo "<br>";$boo = false;}


		//Viruses
		if(itemLine($row['VJ'],"Jarvis","Jarvis Virus")){$boo = true;}
		if(itemLine($row['VA'],"Ada","ADA Refactor")){$boo = true;}
		if($boo){echo "<br>";$boo = false;}


		//Sheilds
		if(itemLine($row['S1'],"Com","Common Shields")){$boo = true;}
		if(itemLine($row['S2'],"Rar","Rare Shields")){$boo = true;}
		if(itemLine($row['S3'],"Ver","Very Rare Shields")){$boo = true;}
		if($boo){echo "<br>";$boo = false;}


		//Mods
		if(itemLine($row['CML'],"Com","Common Link Amp")){$boo = true;}
		if(itemLine($row['RML'],"Rar","Rare Link Amp")){$boo = true;}
		if(itemLine($row['VML'],"Ver","Very Rare Link Amp")){$boo = true;}

		if(itemLine($row['CMH'],"Com","Common Heat Sink")){$boo = true;}
		if(itemLine($row['RMH'],"Rar","Rare Heat Sink")){$boo = true;}
		if(itemLine($row['VMH'],"Ver","Very Rare Heat Sink")){$boo = true;}

		if(itemLine($row['CMM'],"Com","Common Multi-hack")){$boo = true;}
		if(itemLine($row['RMM'],"Rar","Rare Multi-hack")){$boo = true;}
		if(itemLine($row['VMM'],"Ver","Very Rare Multi-hack")){$boo = true;}

		if(itemLine($row['CMF'],"Com","Common Force Amp")){$boo = true;}
		if(itemLine($row['RMF'],"Rar","Rare Force Amp")){$boo = true;}
		if(itemLine($row['VMF'],"Ver","Very Rare Force Amp")){$boo = true;}

		if(itemLine($row['CMT'],"Com","Common Turret")){$boo = true;}
		if(itemLine($row['RMT'],"Rar","Rare Turret")){$boo = true;}
		if(itemLine($row['VMT'],"Ver","Very Rare Turret")){$boo = true;}

		if($boo){echo "<br>";$boo = false;}

		$ItemCount+=$row['CML']+$row['RML']+$row['VML']
					+$row['CMH']+$row['RMH']+$row['VMH']
					+$row['CMM']+$row['RMM']+$row['VMM']
					+$row['CMF']+$row['RMF']+$row['VMF']
					+$row['CMT']+$row['RMT']+$row['VMT'];

		$other+=$row['CML']+$row['RML']+$row['VML']
					+$row['CMH']+$row['RMH']+$row['VMH']
					+$row['CMM']+$row['RMM']+$row['VMM']
					+$row['CMF']+$row['RMF']+$row['VMF']
					+$row['CMT']+$row['RMT']+$row['VMT'];


		//Power Cubes
		for ($i = 1; $i <= 8; $i++) {
			if(itemLine($row['P'.$i],"lvl$i","Level $i Power Cubes")){$boo = true;}
			$ItemCount+=$row['P'.$i];
			$other+=$row['P'.$i];
		}
		if($boo){echo "<br>";$boo = false;}


		//Keys
		itemLine($row['K1'],"Ke","Keys");


		//Items
		$ItemCount+=$row['VA']+$row['VJ']+$row['S1']+$row['S2']+$row['S3']+$row['K1'];
		$other+=	$row['VA']+$row['VJ']+$row['S1']+$row['S2']+$row['S3'];
		if($ItemCount!=0){
			echo "<div id=\"LineLow\">Total ".$ItemCount."</div>";
		}else{
			echo "<div id=\"LineLow\">No inventory data</div>";
		}
		
		echo $Extra;

		//Graph
		$OneP = 20;
		if($ItemCount>2000){$OneP=$ItemCount/100;}
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
