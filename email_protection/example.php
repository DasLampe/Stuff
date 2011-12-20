<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
header('Content-Type: text/html; charset=utf-8');

include_once("postProcess.php");

$html='<html>
		<head>
			<script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
			<script language="JavaScript" type="text/javascript" src="webtoolkit.base64.js"></script>
			<script type="text/javascript">
				$(document).ready(function () {
					$("a").each(function() {
						var href, mailaddress;
						href = $(this).attr("href");
				
						if(href.search(/mailto:/) != -1)
						{
							mailaddress = href.substr(6);
							mailaddress	= Base64.decode(mailaddress);
							$(this).attr("href", "mailto:"+mailaddress);
							
							if($(this).html().search(/ät|at|[ät]|[at]|{at}|{ät}/) != -1)
							{
								$(this).html(mailaddress);
							}
						}
					});
				});
			</script>
		</head>
	<body>
		<p>
			1. daslampe@lano-crew.org<br/>
			2. <a href="mailto:daslampe@lano-crew.org">daslampe@lano-crew.org</a>
		</p>
		
		<h2>Known Bugs:</h2>
		<p>
			If address is already linked and the linked text is a emailaddress too, then the function return something like this:<br/>
			&lt;a href="...."&gt;&lta href="...."&gt;[emailaddress]&lt;/a&gt;&lt/a&gt;<br/>
			(for example see 2.)
	</body>
	</html>';
$html=protectEmail($html);

echo $html;