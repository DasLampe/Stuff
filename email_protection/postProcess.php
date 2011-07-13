<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
function protectEmail($html)
{
	$html	= preg_replace_callback("/([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+/",
	create_function('$args', '
    	    				$text = strtr($args[0],array("@"=> " ät "));$email=base64_encode($args[0]);return "<a title=\"$email\" class=\"email\">$text</a>";   							
    	    			'),
	$html);
	return $html;
}
?>