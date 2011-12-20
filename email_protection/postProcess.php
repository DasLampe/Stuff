<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +--------------------- -------------------------------------------------+
/**
 * Protect Emails with base64 encoding
 * based on https://gist.github.com/907604
 * @param string $html
 * @return string
 */
function protectEmail($html)
{
	$regexp = '/
				( # leading text
					<\w+.?>| # leading HTML tag, or
					[^=:!\'"\/]| # leading punctuation, or
					<a.?href="mailto:|
					^ # beginning of line
				)
					(
						[a-z]+[a-z0-9\-\.\_]+?@[a-z0-9\-\.]+[a-z]{2,6}
					)
				(
					[[:punct:]]||\s|<|$
				) # trailing text
			/x';
	
	return preg_replace_callback($regexp, function($matched) {
		list($all, $before, $address, $after) = $matched;

		// already linked
		if (preg_match('/<a\s/i', $before))
		{
			return preg_replace_callback("/[a-z]+[a-z0-9\-\.\_]+?@[a-z0-9\-\.]+[a-z]{2,6}/x", function($matches){return base64_encode($matches[0]);}, $all);
		}
		
		$at_character	= array("at", "ät", "[at]", "[ät]", "{at}", "{ät}",);
		$text 			= strtr($address,array("@"=> " ".$at_character[rand(0, count($at_character)-1)]." "));
		$address		= base64_encode($address); 

		return $before.'<a href="mailto:'.$address.'">'.$text.'</a>'.$after;
	}, $html);
}
?>