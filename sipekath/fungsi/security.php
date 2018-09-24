<?php
	function antiInjections($string) {
	    $string = stripslashes($string);
	    $string = strip_tags($string);
	    $string = mysql_real_escape_string($string);
	    return $string;
	}

?>