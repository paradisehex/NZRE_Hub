<?php
	include $_SESSION['path']."/Tools/getColour.php";
	
	function echoCell($Num, $Lvl){
		echo "<td style=\"text-align: center;\">";
		if($Num!=0){
			echo "<div id=\"Lvl".$Lvl."\">".$Num."</div>";
		}else{
			echo "<div id=\"Lvl".$Lvl."\">-</div>";
		}
		echo "</td>";
	}

	function echoCellMod($Num, $Lvl){
		$colour = getRarityColour($Lvl); 
		echo "<td style=\"text-align: center;\">";
		if($Num!=0){
			echo "<div style=\"color:".$colour.";text-shadow: 0 0 1px;\" >".$Num."</div>";
		}else{
			echo "<div style=\"color:".$colour.";text-shadow: 0 0 1px;\" >-</div>";
		}
		echo "</td>";
	}

	function echoInv($numofplayers){
		global $res, $xmp, $ult, $jv,$av,$s1,$s2,$s3,$l1,$l2,$l3,$h1,$h2,$h3,$m1,$m2,$m3,$f1,$f2,$f3,$t1,$t2,$t3,$c1,$c2,$c3,$p, $k, $ResTotal, $XmpTotal, $ModTotal, $UltraTotal, $PowerTotal, $other, $total;
		
		
		$total+= $ResTotal + $XmpTotal + $UltraTotal + $PowerTotal + $ModTotal + $c1 + $c2 + $c3;
		
		if($total != 0){
			echo "<div id=\"LineLow\">Out of ".$numofplayers." players</div>";

			echo "<table style=\"margin-left: auto; margin-right: auto; border-spacing: 5;\">
				<tr>
					<td></td>
					<td style=\"text-align: center;\">Res</td>
					<td style=\"text-align: center;\">XMP</td>
					<td style=\"text-align: center;\">Ultra</td>
					<td style=\"text-align: center;\">Cube</td>
				</tr>";
		
		
			for ($i = 1; $i <= 8; $i++) {
			
				echo "<tr>";
				echo "<td><div id=\"lvl".$i."\">L".$i."</div></td>";
					echoCell($res[$i], $i);
					echoCell($xmp[$i], $i);
					echoCell($ult[$i], $i);
					echoCell($p[$i], $i);
				echo "</tr>";
			}
		
			//Totals
				echo "<tr>";
				echo "<td><div style=\"color: #FFFFFF;text-shadow: 0 0 1px;\" >Total</div></td>";
				echoCellMod($ResTotal, 5);
				echoCellMod($XmpTotal, 5);
				echoCellMod($UltraTotal, 5);
				echoCellMod($PowerTotal, 5);
				echo "</tr>";
			
			//Space
				echo "<tr style=\"color: #000000;text-shadow: 0 0 1px;\"><td >.</td></tr>";
			//Mods
				echo "<tr>";
				echo "<td></td>";
				echo "<td><div id=\"Com\" style=\"text-align: center;\">Common</div></td>";
				echo "<td><div id=\"Rar\" style=\"text-align: center;\">Rare</div></td>";
				echo "<td><div id=\"Ver\" style=\"text-align: center;\">Very Rare</div></td>";
				echo "</tr>";
			//ADA
				echo "<tr><td>ADA</td>";
				echo "  <td></td>";
				echo "  <td></td>";
				echoCellMod($av, 3);
				echo "  <td></td>";
				echo "</tr>";
			//Jarvis
				echo "<tr><td>Jarvis</td>";
				echo "  <td></td>";
				echo "  <td></td>";
				echoCellMod($jv, 3);
				echo "  <td></td>";
				echo "</tr>";
			//Shields
				echo "<tr><td>Shields</td>";
				echoCellMod($s1, 1);
				echoCellMod($s2, 2);
				echoCellMod($s3, 3);
				echo "  <td></td>";
				echo "</tr>";
			//Link Amp
				echo "<tr><td>Link Amp</td>";
				echo "  <td></td>";
				echoCellMod($l2, 2);
				echoCellMod($l3, 3);
				echo "  <td></td>";
				echo "</tr>";
			//Heat Sink
				echo "<tr><td>Heat Sink</td>";
				echoCellMod($h1, 1);
				echoCellMod($h2, 2);
				echoCellMod($h3, 3);
				echo "  <td></td>";
				echo "</tr>";
			//Multi hack
				echo "<tr><td>Multi hack</td>";
				echoCellMod($m1, 1);
				echoCellMod($m2, 2);
				echoCellMod($m3, 3);
				echo "  <td></td>";
				echo "</tr>";
			//Force Amp
				echo "<tr><td>Force Amp</td>";
				echo "  <td></td>";
				echoCellMod($f2, 2);
				echo "  <td></td>";
				echo "  <td></td>";
				echo "</tr>";
			//Turret
				echo "<tr><td>Turret</td>";
				echo "  <td></td>";
				echoCellMod($t2, 2);
				echoCellMod($t3, 3);
				echo "  <td></td>";
				echo "</tr>";
			//Turret
				echo "<tr><td>Turret</td>";
				echo "  <td></td>";
				echoCellMod($c2, 2);
				echo "  <td></td>";
				echo "  <td></td>";
				echo "</tr>";
			//Keys
				echo "<tr><td>Keys</td>";
				echoCellMod($k, 4);
				echo "  <td></td>";
				echo "  <td></td>";
				echo "  <td></td>";
				echo "</tr>";
			
			echo "</table>";
			
			$total = $ResTotal+$XmpTotal+$ModTotal+$k+$other;
			echo "<div id=\"LineLow\">Total ".$total."</div>";

			//Graph
			$OneP = 20*$numofplayers;
			if($total > 20*$numofplayers){$OneP = $total/100;}
			echo "<div id=\"Bar\">";
			echo "<div id=\"RES\" style=\"width:".($ResTotal/$OneP)."%;\"></div>";
			echo "<div id=\"XMP\" style=\"width:".($XmpTotal/$OneP)."%;\"></div>";
			echo "<div id=\"MOD\" style=\"width:".($ModTotal/$OneP)."%;\"></div>";
			echo "<div id=\"KEYS\" style=\"width:".($k/$OneP)."%;\"></div>";
			echo "<div id=\"OTH\" style=\"width:".($other/$OneP)."%;\"></div>";
			echo "<div id=\"EMP\" style=\"width:".((($OneP*100)-$other-$k-$XmpTotal-$ResTotal-$ModTotal)/$OneP)."%;\"></div>";
			echo "<div id=\"Key\"><div id=\"R\">Resonators</div><div id=\"X\">Xmps</div><div id=\"M\">Mods</div><div id=\"K\">Keys</div><div id=\"O\">Other</div></div>";
			echo "</div>";
		}else{
			echo "<div id=\"LineLow\">No inventory data</div>";
		}
	}

	function addInventory($row){
		global $res, $xmp, $ult, $jv,$av,$s1,$s2,$s3,$l1,$l2,$l3,$h1,$h2,$h3,$m1,$m2,$m3,$f1,$f2,$f3,$t1,$t2,$t3,$c1,$c2,$c3,$p, $k,$ResTotal, $XmpTotal, $ModTotal, $UltraTotal, $PowerTotal, $other,$total;
		

		for ($i = 1; $i <= 8; $i++) {
			
			$res[$i] += $row['R'.$i];
			$ResTotal += $row['R'.$i];
			
			$xmp[$i] += $row['X'.$i];
			$XmpTotal += $row['X'.$i];
			
			$ult[$i] += $row['U'.$i];
			$UltraTotal+= $row['U'.$i];
			
			$p[$i] += $row['P'.$i];
			$other += $row['P'.$i];
			$PowerTotal += $row['P'.$i];
			
		}



		//Viruses
		$jv +=$row['VJ'];
		$av +=$row['VA'];
		$other +=$row['VJ']+$row['VA'];
		$total +=$row['VJ']+$row['VA'];

		//Mods
		$s1 +=$row['S1'];
		$s2 +=$row['S2'];
		$s3 +=$row['S3'];
		
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

		$c1 +=$row['CC'];
		$c2 +=$row['RC'];
		$c3 +=$row['VC'];
		
		$ModTotal += $row['CML']+$row['RML']+$row['VML']
				+$row['CMH']+$row['RMH']+$row['VMH']
				+$row['CMM']+$row['RMM']+$row['VMM']
				+$row['CMF']+$row['RMF']+$row['VMF']
				+$row['CMT']+$row['RMT']+$row['VMT']
				+$row['S1']+$row['S2']+$row['S3'];
		
		$other += $row['CC']+$row['RC']+$row['VC'];

		//Keys
		$k +=$row['K1'];
	}
?>
