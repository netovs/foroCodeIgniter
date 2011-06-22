<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo @$title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/style/style.css"/>
<style type="text/css">
body {
 background-color: #fdc689;
 margin: 40px;
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h1 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}
</style>

<?php 
if(@$javascript == 1)
{
?>
<script type="text/javascript" src="<?php echo $jquery; ?>"></script>
<script type="text/javascript" src="<?php echo $tinyMce; ?>"></script>
<script type="text/javascript" src="<?php echo $tinyMceJquery; ?>"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo $tinyMce; ?>',

			// General options
			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			// theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "http://<?php echo $_SERVER['HTTP_HOST']; ?>/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script>


<link type="text/css" rel="stylesheet" href="http://jqueryui.com/themes/base/jquery.ui.all.css"/>
<script type="text/javascript" src="<?php echo $uicore; ?>"></script>
<script type="text/javascript" src="<?php echo $uiwidget; ?>"></script>
<script type="text/javascript" src="<?php echo $datepicker; ?>"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$( "#anim" ).change(function() {
			$( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
		});
		
	});
	</script>
<script type="text/javascript" src="<?php echo $ddaccordion; ?>"></script>
<style type="text/css">
.respuesta{ /*header of 2nd demo*/
cursor: hand;
cursor: pointer;
font: bold 14px Arial;
margin: 10px 0;
}


.abreRespuesta{ /*class added to contents of 2nd demo when they are open*/
color: green;
}

.cierraRespuesta{ /*class added to contents of 2nd demo when they are closed*/
color: red;
}

.listaRespuestas
{
	width: 100%;
	text-align: left;
}

</style>

<script type="text/javascript">
ddaccordion.init({
	headerclass: "respuesta", //Shared CSS class name of headers group
	contentclass: "listaRespuestas", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: false, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: false, //persist state of opened contents within browser session?
	toggleclass: ["cierraRespuesta", "abreRespuesta"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	// togglehtml: ["prefix", "<img src='http://i13.tinypic.com/80mxwlz.gif' style='width:13px; height:13px' /> ", "<img src='http://i18.tinypic.com/6tpc4td.gif' style='width:13px; height:13px' /> "], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>

<?php
} 
?>

<script type="text/javascript">
function confirmarAlgo(que)
{
	var ruta = que;
	var confirmar = confirm("Este cambio sera definitivo, continuar?");
	if(confirmar)
	{
		window.location = que;
	}
	else
	{
		return false;
	}
}
</script>

</head>
<body>