<?php
	function LogText($String){
		$time = date('H',time()).":".date('i',time())." ".date('d',time())."/".date('m',time());
		insert("LogTable",array($time,$String));
	}
?>
