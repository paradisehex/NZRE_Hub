<?php

	function echoInv($numofplayers){
		global $res1,$res2,$res3,$res4,$res5,$res6,$res7,$res8,$xmp1,$xmp2,$xmp3,$xmp4,$xmp5,$xmp6,$xmp7,$xmp8,$jv,$av,$s1,$s2,$s3,$l1,$l2,$l3,$h1,$h2,$h3,$m1,$m2,$m3,$f1,$f2,$f3,$t1,$t2,$t3,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$k,$Res,$Xmp,$other,$total;
		$boo = false;

		function itemLine($Num,$ID,$Des){
			if($Num!=0){
				echo "<div id=\"LineLow\"><div id=\"Left\">".$Des."</div><div id=\"Right\"><div id=\"".$ID."\">".$Num."</div></div></div>";
				return true;
			}
			return $boo;
		}


		echo "<div id=\"LineLow\">Out of ".$numofplayers." players</div>";


		//Res
		if(itemLine($res1,"lvl1","Level 1 Resonators")){$boo = true;}
		if(itemLine($res2,"lvl2","Level 2 Resonators")){$boo = true;}
		if(itemLine($res3,"lvl3","Level 3 Resonators")){$boo = true;}
		if(itemLine($res4,"lvl4","Level 4 Resonators")){$boo = true;}
		if(itemLine($res5,"lvl5","Level 5 Resonators")){$boo = true;}
		if(itemLine($res6,"lvl6","Level 6 Resonators")){$boo = true;}
		if(itemLine($res7,"lvl7","Level 7 Resonators")){$boo = true;}
		if(itemLine($res8,"lvl8","Level 8 Resonators")){$boo = true;}
		if($boo){echo "<br>";$boo = false;}


		//Xmps
		if(itemLine($xmp1,"lvl1","Level 1 Xmp Bursters")){$boo = true;}
		if(itemLine($xmp2,"lvl2","Level 2 Xmp Bursters")){$boo = true;}
		if(itemLine($xmp3,"lvl3","Level 3 Xmp Bursters")){$boo = true;}
		if(itemLine($xmp4,"lvl4","Level 4 Xmp Bursters")){$boo = true;}
		if(itemLine($xmp5,"lvl5","Level 5 Xmp Bursters")){$boo = true;}
		if(itemLine($xmp6,"lvl6","Level 6 Xmp Bursters")){$boo = true;}
		if(itemLine($xmp7,"lvl7","Level 7 Xmp Bursters")){$boo = true;}
		if(itemLine($xmp8,"lvl8","Level 8 Xmp Bursters")){$boo = true;}
		if($boo){echo "<br>";$boo = false;}


		//Viruses
		if(itemLine($jv,"Jarvis","Jarvis Virus")){$boo = true;}
		if(itemLine($av,"Ada","ADA Refactor")){$boo = true;}
		if($boo){echo "<br>";$boo = false;}


		//Sheilds
		if(itemLine($s1,"Com","Common Shields")){$boo = true;}
		if(itemLine($s2,"Rar","Rare Shields")){$boo = true;}
		if(itemLine($s3,"Ver","Very Rare Shields")){$boo = true;}
		if($boo){echo "<br>";$boo = false;}


		//Mods
		if(itemLine($l1,"Com","Common Link Amp")){$boo = true;}
		if(itemLine($l2,"Rar","Rare Link Amp")){$boo = true;}
		if(itemLine($l3,"Ver","Very Rare Link Amp")){$boo = true;}

		if(itemLine($h1,"Com","Common Heat Sink")){$boo = true;}
		if(itemLine($h2,"Rar","Rare Heat Sink")){$boo = true;}
		if(itemLine($h3,"Ver","Very Rare Heat Sink")){$boo = true;}

		if(itemLine($m1,"Com","Common Multi-hack")){$boo = true;}
		if(itemLine($m2,"Rar","Rare Multi-hack")){$boo = true;}
		if(itemLine($m3,"Ver","Very Rare Multi-hack")){$boo = true;}

		if(itemLine($f1,"Com","Common Force Amp")){$boo = true;}
		if(itemLine($f2,"Rar","Rare Force Amp")){$boo = true;}
		if(itemLine($f3,"Ver","Very Rare Force Amp")){$boo = true;}

		if(itemLine($t1,"Com","Common Turret")){$boo = true;}
		if(itemLine($t2,"Rar","Rare Turret")){$boo = true;}
		if(itemLine($t3,"Ver","Very Rare Turret")){$boo = true;}

		if($boo){echo "<br>";$boo = false;}


		//Power Cubes
		for ($i = 1; $i <= 8; $i++) {
			if(itemLine($row['P'.$i],"lvl$i","Level $i Power Cubes")){$boo = true;}
			$ItemCount+=$row['P'.$i];
			$other+=$row['P'.$i];
		}
		if(itemLine($p1,"lvl1","Level 1 Power Cubes")){$boo = true;}
		if(itemLine($p2,"lvl2","Level 2 Power Cubes")){$boo = true;}
		if(itemLine($p3,"lvl3","Level 3 Power Cubes")){$boo = true;}
		if(itemLine($p4,"lvl4","Level 4 Power Cubes")){$boo = true;}
		if(itemLine($p5,"lvl5","Level 5 Power Cubes")){$boo = true;}
		if(itemLine($p6,"lvl6","Level 6 Power Cubes")){$boo = true;}
		if(itemLine($p7,"lvl7","Level 7 Power Cubes")){$boo = true;}
		if(itemLine($p8,"lvl8","Level 8 Power Cubes")){$boo = true;}
		if($boo){echo "<br>";$boo = false;}


		//Keys
		itemLine($k,"Ke","Keys");


		//Items
		if($total!=0){
			echo "<div id=\"LineLow\">Total ".$total."</div>";
		}else{
			echo "<div id=\"LineLow\">No inventory data</div>";
		}

		//Graph
		$OneP = 20*$numofplayers;
		echo "<div id=\"Bar\">";
		echo "<div id=\"RES\" style=\"width:".($Res/$OneP)."%;\"></div>";
		echo "<div id=\"XMP\" style=\"width:".($Xmp/$OneP)."%;\"></div>";
		echo "<div id=\"KEYS\" style=\"width:".($k/$OneP)."%;\"></div>";
		echo "<div id=\"OTH\" style=\"width:".($other/$OneP)."%;\"></div>";
		echo "<div id=\"EMP\" style=\"width:".((2000-$other-$k-$Xmp-$Res)/$OneP)."%;\"></div>";
		echo "<div id=\"Key\"><div id=\"R\">Resonators</div><div id=\"X\">Xmps</div><div id=\"K\">Keys</div><div id=\"O\">Other</div></div>";
		echo "</div>";
	}

	function addInventory($row){
		global $res1,$res2,$res3,$res4,$res5,$res6,$res7,$res8,$xmp1,$xmp2,$xmp3,$xmp4,$xmp5,$xmp6,$xmp7,$xmp8,$jv,$av,$s1,$s2,$s3,$l1,$l2,$l3,$h1,$h2,$h3,$m1,$m2,$m3,$f1,$f2,$f3,$t1,$t2,$t3,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$k,$Res,$Xmp,$other,$total;
		//Res
		$res1 +=$row['R1'];
		$res2 +=$row['R2'];
		$res3 +=$row['R3'];
		$res4 +=$row['R4'];
		$res5 +=$row['R5'];
		$res6 +=$row['R6'];
		$res7 +=$row['R7'];
		$res8 +=$row['R8'];
		$Res +=$row['R1']+$row['R2']+$row['R3']+$row['R4']+$row['R5']+$row['R6']+$row['R7']+$row['R8'];
		$total +=$row['R1']+$row['R2']+$row['R3']+$row['R4']+$row['R5']+$row['R6']+$row['R7']+$row['R8'];


		//Xmps
		$xmp1 +=$row['X1'];
		$xmp2 +=$row['X2'];
		$xmp3 +=$row['X3'];
		$xmp4 +=$row['X4'];
		$xmp5 +=$row['X5'];
		$xmp6 +=$row['X6'];
		$xmp7 +=$row['X7'];
		$xmp8 +=$row['X8'];
		$Xmp+=$row['X1']+$row['X2']+$row['X3']+$row['X4']+$row['X5']+$row['X6']+$row['X7']+$row['X8'];
		$total +=$row['X1']+$row['X2']+$row['X3']+$row['X4']+$row['X5']+$row['X6']+$row['X7']+$row['X8'];


		//Viruses
		$jv +=$row['VJ'];
		$av +=$row['VA'];
		$other +=$row['VJ']+$row['VA'];
		$total +=$row['VJ']+$row['VA'];


		//Sheilds
		$s1 +=$row['S1'];
		$s2 +=$row['S2'];
		$s3 +=$row['S3'];
		$other +=$row['S1']+$row['S2']+$row['S3'];
		$total +=$row['S1']+$row['S2']+$row['S3'];


		//Mods
		$l1 +=$row['CML'];
		$l2 +=$row['RML'];
		$l3 +=$row['VML'];

		$h1 +=$row['CMH'];
		$h2 +=$row['RMH'];
		$h3 +=$row['VMH'];

		$m1 +=$row['CMM'];
		$m2 +=$row['RMM'];
		$m3 +=$row['VMM'];

		$f1 +=$row['CMF'];
		$f2 +=$row['RMF'];
		$f3 +=$row['VMF'];

		$t1 +=$row['CMT'];
		$t2 +=$row['RMT'];
		$t3 +=$row['VMT'];
		$other +=$row['CML']+$row['RML']+$row['VML']+$row['CMH']+$row['RMH']+$row['VMH']+$row['CMM']+$row['RMM']+$row['VMM']+$row['CMF']+$row['RMF']+$row['VMF'];
		$total +=$row['CML']+$row['RML']+$row['VML']+$row['CMH']+$row['RMH']+$row['VMH']+$row['CMM']+$row['RMM']+$row['VMM']+$row['CMF']+$row['RMF']+$row['VMF'];


		//Power Cubes
		$p1 +=$row['P1'];
		$p2 +=$row['P2'];
		$p3 +=$row['P3'];
		$p4 +=$row['P4'];
		$p5 +=$row['P5'];
		$p6 +=$row['P6'];
		$p7 +=$row['P7'];
		$p8 +=$row['P8'];
		$other+=$row['P1']+$row['P2']+$row['P3']+$row['P4']+$row['P5']+$row['P6']+$row['P7']+$row['P8'];
		$total+=$row['P1']+$row['P2']+$row['P3']+$row['P4']+$row['P5']+$row['P6']+$row['P7']+$row['P8'];


		//Keys
		$k +=$row['K1'];
	}


	$res1 = 0;
	$res2 = 0;
	$res3 = 0;
	$res4 = 0;
	$res5 = 0;
	$res6 = 0;
	$res7 = 0;
	$res8 = 0;
	$xmp1 = 0;
	$xmp2 = 0;
	$xmp3 = 0;
	$xmp4 = 0;
	$xmp5 = 0;
	$xmp6 = 0;
	$xmp7 = 0;
	$xmp8 = 0;
	$jv = 0;
	$av = 0;
	$s1 = 0;
	$s2 = 0;
	$s3 = 0;
	$l1 = 0;
	$l2 = 0;
	$l3 = 0;
	$h1 = 0;
	$h2 = 0;
	$h3 = 0;
	$m1 = 0;
	$m2 = 0;
	$m3 = 0;
	$f1 = 0;
	$f2 = 0;
	$f3 = 0;
	$t1 = 0;
	$t2 = 0;
	$t3 = 0;
	$p1 = 0;
	$p2 = 0;
	$p3 = 0;
	$p4 = 0;
	$p5 = 0;
	$p6 = 0;
	$p7 = 0;
	$p8 = 0;
	$k = 0;

	$Res = 0;
	$Xmp = 0;
	$other = 0;

	$total = 0;
?>
