<?php
$NumOfLocation = 15;
$NumOfStatus = 10;

function getLocationName($ID){
	switch ($ID){
		case 0: return "New Zealand";
		case 1:  return "Northland";
		case 2:  return "Auckland";
		case 3:  return "Waikato";
		case 4:  return "Bay of Plenty";
		case 5:  return "Gisborne";
		case 6:  return "Hawke's Bay";
		case 7:  return "Taranaki";
		case 8:  return "Manawatu-Wanganui";
		case 9:  return "Wellington";
		case 10:  return "Nelson-Tasman";
		case 11:  return "Marlborough";
		case 12:  return "West Coast";
		case 13:  return "Canterbury";
		case 14:  return "Otago";
		case 15:  return "Southland";
	}
}

function getPortalID($Name){
	$row = mysqli_fetch_array(selectFrom("PortalTable", array("portalName"), array($Name)));
	return $row['ID'];
}
?>
