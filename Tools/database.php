<?php
	
	//Get rid of people who haven't logged in
	if(!$_SESSION['name']){
		header("location:/Ingress");
		return;
	}
	
	function cleanData($String){
		$String = strip_tags($String);
		$String = mysql_real_escape_string($String);
		
		return $String;
	}
	
	
	function selectFrom($Table, $Fields, $Vaules){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "SELECT * FROM ".$Table;
		
		if($Fields != null){
			$SQL .= " WHERE ";
		
			$SQL .= $Fields[0]."='".cleanData($Vaules[0])."'";
		
			$length = count($Fields);
			for ($i = 1; $i < $length; $i++) {
				$SQL .= " and ".$Fields[$i]."='".cleanData($Vaules[$i])."'";
			}
		}
		return mysqli_query($Con, $SQL);
	}
	
	
	function update($Table, $SetFields, $SetVaules, $WhereField, $WhereVaule){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "UPDATE $Table SET ".$SetFields[0]." = '".cleanData($SetVaules[0])."' ";
		
		$length = count($SetFields);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= " , ".$SetFields[$i]."='".cleanData($SetVaules[$i])."'";
		}
		
		$SQL .= " WHERE $WhereField = '".cleanData($WhereVaule)."'";
		
		mysqli_query($Con, $SQL);
	}
	
	
	function insert($Table, $Vaules){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "insert into $Table values('".cleanData($Vaules[0])."'";
		
		$length = count($Vaules);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= ",'".cleanData($Vaules[$i])."'";
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
		
		$SQL .= ") values('".cleanData($Vaules[0])."'";
		
		$length = count($Vaules);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= ",'".cleanData($Vaules[$i])."'";
		}
		
		$SQL .= ");";
		mysqli_query($Con, $SQL);
	}
	
	function deleteFrom($Table, $Fields, $Vaules){
		include $_SESSION['path']."/.data/DB_PASSWORD.php";
		$Con = mysqli_connect($HOST,$USER,$PSWD,$DB);
		
		$SQL = "delete FROM ".$Table." WHERE ";
		
		$SQL .= $Fields[0]."='".cleanData($Vaules[0])."'";
		
		$length = count($Fields);
		for ($i = 1; $i < $length; $i++) {
			$SQL .= " and ".$Fields[$i]."='".cleanData($Vaules[$i])."'";
		}
		
		mysqli_query($Con, $SQL);
	}
?>
