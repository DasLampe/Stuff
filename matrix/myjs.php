<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <daslampe@lano-crew.org> |
// | Encoding: UTF-8 |
// +----------------------------------------------------------------------+
header('Content-Type: text/html; charset=utf-8');
?>
<style type="text/css">
html body { font-family: courier, monospace;
			background-color: #000000;
			color: green;
			font-size: 30pt;
}
#hal { text-decoration: blink;}
div {
	width: 800px;
	margin: auto;
}
</style>
<script type="text/javascript" src="./jquery.js"></script>
<script type="text/javascript">
jQuery(function(){
	var a = [
	     	'Javascript Stuff:',
	     	'Matrix like Wordpress Easteregg',
	     	'© DasLampe 2011',
	     	'Have fun!',
	   	];
   	var h=jQuery('#hal');

   	var outputArray=[];

   	function hal2() {
   	   	if(outputArray == "")
   	   	{
   	   	   	output = 'undefined';
   	   	}
   	   	else
   	   	{
   	   	   	output = outputArray;
   	   	}
		
   	   	if(output == 'undefined')
   	   	{
   	   		outputArray=a.shift();
   	   	   	outputArray=outputArray.split('');
   	   		h.before('<br />');
   	   		setTimeout(hal2, 200);
   	   	}
   	   	else
   	   	{
			h.before(outputArray[0]);
			outputArray.shift();
			setTimeout(hal2,200);
   	   	}
   	};
   	hal2();
	    	
});
</script>

<div>
<blink id="hal">&#x258c;</blink>
</div>