<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once("postProcess.php");

$html='<html>
		<head>
			<script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
			<script language="JavaScript" type="text/javascript" src="webtoolkit.base64.js"></script>
			<script type="text/javascript">
			$(document).ready(function () {	
				$("a.email").each(function(){
					var maddress = Base64.decode($(this).attr("title"));
						$(this).attr( "href", "mailto:" + maddress );
						$(this).html( maddress );
						$(this).attr( "title", "" );
				});
			});
			</script>
		</head>
	<body>
		daslampe@lano-crew.org
	</body>
	</html>';
$html=protectEmail($html);

echo $html;