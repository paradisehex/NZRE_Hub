<?php
	function LogText($String){
		$file = '/var/www/Ingress/.data/Log.txt';
		$output = date('H',time()).":".date('i',time())." ".date('d',time())."/".date('m',time())."-".$String."\n";
		$output .= file_get_contents($file);
		file_put_contents($file, $output,LOCK_EX);
	}
?>
