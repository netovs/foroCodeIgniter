<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="Bufete Jurídico Nacional">

	<title>Foro bufete nacional</title>
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
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/style/style.css"/>

<script type="text/javascript" src="http://bufetenacional.org/foro/static/javascript/jquery.js"></script>
<script type="text/javascript" src="http://bufetenacional.org/foro/static/javascript/ddaccordion.js"></script>

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

</head>
<body>
<h1>Bienvenido al foro</h1>
<!-- Listado de temas -->
<?php 
// echo BASE_URL;
?>

<div class="listado">
	<center>
	<?php
	echo $this -> pagination -> create_links();
	?>
	</center>
	<?php 
	if(@$sinTemas)
	{
		echo $sinTemas;
	} 
	else
	{
		foreach($temas as $det):
		if($det['status'] == 1)
		{
?>
<div class="individual" id="tema-<?php echo $det['id']; ?>">
	<div class="tituloInd"><?php echo anchor('foro/detalleTema/' . $det['id'], $det['tema']); ?></div>
	<div class="fecha"><p align="right"><?php echo $det['fecha']; ?></p></div>
	<div class="subTituloInd"><center><?php echo $det['descripcion']; ?></center></div>
 <!-- 
	<div class="textoDetalle">
	<?php echo $det['texto']; ?>
	</div>
-->
<div style="clear: both;"></div>
<div style="text-align: right;">
<?php
// echo '<span class="respuesta">Participe en nuestro foro</span><br/></div><div class="listaRespuestas">';
// if($respuestasDetalle)
//{
//foreach($respuestasDetalle as $detResp):
//	if($det['id'] == $detResp['nuevo_foro_id'])
//	{
//		if($detResp['aprobado'] == 1)
//		{
?>
<!-- 
<b>Nombre: </b><?php echo $detResp['nombre']; ?> <b>Fecha: </b><?php echo $detResp['fecha']; ?> <br/>
<b>Comentario:</b> <?php echo $detResp['respuesta']; ?> <br/>
-->
<?php
//		}
//	}
//echo '<br/><hr/>';
//echo form_open('foro/registraRespuesta/' . $det['id']);
//echo form_close(); 
//endforeach;

//}
}
?>
</div>
<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
<hr/>
<?php
	endforeach;
}
?>

</div>

</body>
</html>
