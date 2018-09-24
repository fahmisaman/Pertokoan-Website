<?php
	function strleft($s1, $s2) { 
		return substr($s1, 0, strpos($s1, $s2));
	}   
			  
	function selfURL() { 
		if(!isset($_SERVER['REQUEST_URI'])) { 
		   $serverrequri = $_SERVER['PHP_SELF']; 
		}
		else { 
		   $serverrequri = $_SERVER['REQUEST_URI']; 
		} 
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
		$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
		$_SESSION['ref'] = $protocol."://>/".$_SERVER['SERVER_NAME'].$port.$serverrequri; 
	}	

?>