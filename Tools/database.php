<?php
	
	//Get rid of people who haven't logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
		return;
	}
	
	
	function selectFrom($Table, $Fields, $Vaules){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "SELECT * FROM ".$Table;
		
		if($Fields != null){
			$SQL .= " WHERE ";
		
			$SQL .= $Fields[0]."='".$Vaules[0]."'";
		
			$length = count($Fields);
			for ($i = 1; $i < $length; $i++) {
				$SQL .= " and ".$Fields[$i]."='".$Vaules[$i]."'";
			}
		}
		return mysqli_query($Con, $SQL);
	}
	
	
	function update($Table, $SetFields, $SetVaules, $WhereField, $WhereVaule){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "UPDATE $Table SET ".$SetFields[0]." = '".$SetVaules[0]."' ";
		
		$length = count($SetFields);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= " , ".$SetFields[$i]."='".$SetVaules[$i]."'";
		}
		
		$SQL .= " WHERE $WhereField = '$WhereVaule'";
		
		mysqli_query($Con, $SQL);
	}
	
	
	function insert($Table, $Vaules){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "insert into $Table values('".$Vaules[0]."'";
		
		$length = count($Vaules);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= ",'".$Vaules[$i]."'";
		}
		
		$SQL .= ");";
		
		mysqli_query($Con, $SQL);
	}
	
	
	function insertCertainVaules($Table, $Fields, $Vaules){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "insert into $Table";
		
		$SQL .= " (".$Fields[0];
		
		$length = count($Fields);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= ",".$Fields[$i];
		}
		
		$SQL .= ") values('".$Vaules[0]."'";
		
		$length = count($Vaules);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= ",'".$Vaules[$i]."'";
		}
		
		$SQL .= ");";
		mysqli_query($Con, $SQL);
	}
	
	function deleteFrom($Table, $Fields, $Vaules){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "delete FROM ".$Table." WHERE ";
		
		$SQL .= $Fields[0]."='".$Vaules[0]."'";
		
		$length = count($Fields);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= " and ".$Fields[$i]."='".$Vaules[$i]."'";
		}
		
		mysqli_query($Con, $SQL);
	}
?>
