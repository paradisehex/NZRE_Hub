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

function getPortalStatus($ID){
	switch ($ID){
		case 0:  return "No Status";
		case 1:  return "Farm for keys";
		case 2:  return "Protect";
		case 3:  return "Destroy";
		case 4:  return "Agreed shared farm";
		case 5:  return "Agreed RE farm";
		case 6:  return "Agreed EN farm";
		case 7:  return "Keep green";
		case 8:  return "Don't touch";
		case 9:  return "Low level only";
		case 10:  return "Other";
	}
}

function getPortalID($Name){
	$row = mysqli_fetch_array(selectFrom("PortalTable", array("portalName"), array($Name)));
	return $row['ID'];
}
?>
