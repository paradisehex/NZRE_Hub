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

	function echoInv($row){
		$ItemCount = 0;

		$Res = 0;
		$Xmp = 0;
		$Ultra = 0;
		$Cube = 0;
		$Mod = 0;
		$other = 0;
		
		$lvls = array(0,0,0,0,0,0,0,0);
		$raritys = array (0,0,0);

		echo "<table style=\"margin-left: auto; margin-right: auto; border-spacing: 5;\">
					<tr>
						<td></td>
						<td style=\"text-align: center;\">Res</td>
						<td style=\"text-align: center;\">XMP</td>
						<td style=\"text-align: center;\">Ultra</td>
						<td style=\"text-align: center;\">Cube</td>
					</tr>";
		
		
		for ($i = 1; $i <= 8; $i++) {
			$Res += $row['R'.$i];
			$Xmp += $row['X'.$i];
			$Ultra += $row['U'.$i];
			$Cube += $row['P'.$i];
			
			$lvls[$i-1] += $row['R'.$i] + $row['X'.$i] + $row['U'.$i] + $row['P'.$i];
			
			echo "<tr>";
			echo "<td><div id=\"lvl".$i."\">L".$i."</div></td>";
				echoCell($row["R".$i], $i);
				echoCell($row["X".$i], $i);
				echoCell($row['U'.$i] , $i);
				echoCell($row["P".$i], $i);
			echo "</tr>";
		}
		
		$ItemCount += $Res+$Xmp+$Ultra+$Cube;
		$other += $Cube;
		
		
		//Totals
			echo "<tr>";
			echo "<td><div style=\"color: #FFFFFF;text-shadow: 0 0 1px;\" >Total</div></td>";
			echoCellMod($Res, 5);
			echoCellMod($Xmp, 5);
			echoCellMod($Ultra, 5);
			echoCellMod($Cube, 5);
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
			echo "<td></td>";
			echo "<td></td>";
			echoCellMod($row["VA"], 3);
			echo "<td></td>";
			echo "</tr>";
		//Jarvis
			echo "<tr><td>Jarvis</td>";
			echo "<td></td>";
			echo "<td></td>";
			echoCellMod($row["VJ"], 3);
			echo "<td></td>";
			echo "</tr>";
		//Shields
			echo "<tr><td>Shields</td>";
			echoCellMod($row["S1"], 1);
			echoCellMod($row["S2"], 2);
			echoCellMod($row["S3"], 3);
			echo "<td></td>";
			echo "</tr>";
		//Link Amp
			echo "<tr><td>Link Amp</td>";
			echo "<td></td>";
			echoCellMod($row["RML"], 2);
			echoCellMod($row["VML"], 3);
			echo "<td></td>";
			echo "</tr>";
		//Heat Sink
			echo "<tr><td>Heat Sink</td>";
			echoCellMod($row["CMH"], 1);
			echoCellMod($row["RMH"], 2);
			echoCellMod($row["VMH"], 3);
			echo "<td></td>";
			echo "</tr>";
		//Multi hack
			echo "<tr><td>Multi hack</td>";
			echoCellMod($row["CMM"], 1);
			echoCellMod($row["RMM"], 2);
			echoCellMod($row["VMM"], 3);
			echo "<td></td>";
			echo "</tr>";
		//Force Amp
			echo "<tr><td>Force Amp</td>";
			echo "<td></td>";
			echoCellMod($row["RMF"], 2);
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
		//Turret
			echo "<tr><td>Turret</td>";
			echo "<td></td>";
			echoCellMod($row["RMT"], 2);
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
		//Keys
			echo "<tr><td>Keys</td>";
			echoCellMod($row["K1"], 4);
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			
		echo "</table>";

		$Mod +=$row['CML']+$row['RML']+$row['VML']
					+$row['CMH']+$row['RMH']+$row['VMH']
					+$row['CMM']+$row['RMM']+$row['VMM']
					+$row['CMF']+$row['RMF']+$row['VMF']
					+$row['CMT']+$row['RMT']+$row['VMT']
					+$row['S1']+$row['S2']+$row['S3'];
					
		$raritys[0] += $row['CML'] + $row['CMH'] + $row['CMM'] + $row['CMF'] + $row['CMT'] + $row['S1'];
		$raritys[1] += $row['RML'] + $row['RMH'] + $row['RMM'] + $row['RMF'] + $row['RMT'] + $row['S2'];
		$raritys[2] += $row['VML'] + $row['VMH'] + $row['VMM'] + $row['VMF'] + $row['VMT'] + $row['S3'] + $row['VA'] + $row['VJ'];
					
		$ItemCount+= $Mod;

		//Items
		$ItemCount += $row['VA']+$row['VJ']+$row['K1'];
		$other += $row['VA']+$row['VJ'];
		if($ItemCount!=0){
			echo "<div id=\"LineLow\">Total ".$ItemCount."</div>";
		}else{
			echo "<div id=\"LineLow\">No inventory data</div>";
		}

		//Graph
		$OneP = 20;
		if($ItemCount>2000){$OneP=$ItemCount/100;}
		echo "<div id=\"Bar\">";
		echo "<div id=\"RES\" style=\"width:".($Res/$OneP)."%;\"></div>";
		echo "<div id=\"XMP\" style=\"width:".(($Xmp+$Ultra)/$OneP)."%;\"></div>";
		echo "<div id=\"MOD\" style=\"width:".($Mod/$OneP)."%;\"></div>";
		echo "<div id=\"KEYS\" style=\"width:".($row['K1']/$OneP)."%;\"></div>";
		echo "<div id=\"OTH\" style=\"width:".($other/$OneP)."%;\"></div>";
		echo "<div id=\"EMP\" style=\"width:0%;\"></div>";
		echo "<div id=\"Key\"><div id=\"R\">Resonators</div><div id=\"X\">Weapons</div><div id=\"M\">Mods</div><div id=\"K\">Keys</div><div id=\"O\">Other</div></div>";
		echo "</div><br><br>";
		
		echo "<div id=\"Bar\">";
			echo "<div id=\"BAR_1\" style=\"width:".($lvls[0]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_2\" style=\"width:".($lvls[1]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_3\" style=\"width:".($lvls[2]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_4\" style=\"width:".($lvls[3]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_5\" style=\"width:".($lvls[4]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_6\" style=\"width:".($lvls[5]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_7\" style=\"width:".($lvls[6]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_8\" style=\"width:".($lvls[7]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_C\" style=\"width:".($raritys[0]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_R\" style=\"width:".($raritys[1]/$OneP)."%;\"></div>";
			echo "<div id=\"BAR_V\" style=\"width:".($raritys[2]/$OneP)."%;\"></div>";
			echo "<div id=\"KEYS\" style=\"width:".($row['K1']/$OneP)."%;\"></div>";
			echo "<div id=\"EMP\" style=\"width:0%;\"></div>";
			echo "<div id=\"Key\">
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl1\">L 1</div></div>
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl2\">L 2</div></div>
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl3\">L 3</div></div>
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl4\">L 4</div></div>
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl5\">L 5</div></div>
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl6\">L 6</div></div>
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl7\">L 7</div></div>
				<div id=\"R\" style=\"width: 6%;\"><div id=\"lvl8\">L 8</div></div>
				<div id=\"R\" style=\"width: 9%;\"><div id=\"Com\">Com</div></div>
				<div id=\"R\" style=\"width: 10%;\"><div id=\"Rar\">Rare</div></div>
				<div id=\"R\" style=\"width: 10%;\"><div id=\"Ver\">V.Rare</div></div>
				<div id=\"R\" style=\"width: 14%;\"><div id=\"Ke\">Keys</div></div>
			</div>";
		echo "</div><br><br>";
	}
?>
