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

<script type="text/javascript" src="http://bufetenacional.org/foro/static/javascript/jquery.js"></script>
<script type="text/javascript" src="http://bufetenacional.org/foro/static/javascript/jqueryForm.js"></script>
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

<script type="text/javascript">

function showBusy()
{
    $('#busy').show('slow');
}

function processForm(html)
{

    $('#errors').hide('slow');
    
    window.setTimeout( function(){
         
        $('#busy').hide('slow');
        
        {}
        if(parseFloat(html))
         {
             $('#fomulario').hide('slow');
             $('#errors').hide('slow');
         }
        else
         {
             $('#errors').html(html).show('slow');
         }
         
     }, 3000);

}

$(document).ready(function() {

    $('#validationForm').submit(function(eve){
        eve.preventDefault();
        
        $.ajax({
            url: "<?php echo BASE_URL . 'foro/registraRespuesta/' . $temas[0]['id']; ?>",
            type: "POST",
            dataType: "html",
            data: $('#validationForm').serialize(),
            beforeSend: function(){
                showBusy();
            },
    
              success: function(html) {
                processForm(html);
                // alert('se envia sin validar');
             }
        });
        

    });

}); 


</script>

	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/style/style.css"/>


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
	<div class="tituloInd"><?php echo $det['tema']; ?></div>
	<div class="fecha"><p align="right"><?php echo $det['fecha']; ?></p></div>
	<div class="subTituloInd"><center><?php echo $det['descripcion']; ?></center></div>
 
	<div class="textoDetalle">
	<?php echo $det['texto']; ?>
	</div>
<div style="clear: both;"></div>
</div>

<div style="text-align: right;">
<?php
echo '<span class="respuesta">Participe en nuestro foro</span><br/></div><div class="listaRespuestas">';
if($respuestasDetalle)
{
foreach($respuestasDetalle as $detResp):
	if($det['id'] == $detResp['nuevo_foro_id'])
	{
		if($detResp['aprobado'] == 1)
		{
?>
<h2>Opiniones: </h2>

<b>Nombre: </b><?php echo $detResp['nombre']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span align="right"><b>Fecha: </b><?php echo $detResp['fecha']; ?></span><br/>
<b>Comentario:</b> <?php echo $detResp['respuesta']; ?> <br/>

<?php
		}
	}
endforeach;

}
?>
<div id="busy" style="display:none">
Enviando respuesta <br><center><img width="30px" height="30px" src="<?php echo BASE_URL; ?>static/imgs/ajax-loader.gif" /></center>
</div>
<br/>

<?php 
echo '<br/><hr/>
<div id="errors" style="display: none; width: 150px;">' . form_error('nombre') . '</div>
<div id="fomulario"><table width = "400px">';
$atribs = array('name' => 'respuesta', 'id' => 'validationForm');

// $palabra = BASE_URL.'static/palabras/palabras.php';

echo form_open('foro/registraRespuesta/' . $det['id'], $atribs);
echo '<tr><td width="100px"><label>Nombre: <span style="color: #990000;">*</span></label></td><td width="300px">' . form_input('nombre') . '</td></tr>';
echo '<tr><td width="100px"><label>Correo electr&oacute;nico: <span style="color: #990000;">*</span></label></td><td width="300px">' . form_input('email','','id="email"') . '</td></tr>';
echo '<tr><td width="100px" valign="top"><label>Opini&oacute;n: </label></td><td width="300px">' . form_textarea('opinion','','', 20, 5) . '</td></tr>';
// echo '<tr><td width="100px"><label>Valor de seguridad: </label></td><td width="300px">' . $valor1 . ' + ' .$valor2 . ' = ' . $resp. '<br/>' . form_input('cvesp', '', '') . '<br><div id="error3"></div></td></tr>';
echo '<tr><td align="right" colspan="2"> <input type="button" value="Recargar" onClick="window.location.reload()">' .form_submit('enviar','Aceptar'). '</td></tr></table>';

echo form_close();
echo '</table></div>'; 
}
?>
</div>
<div style="clear: both;"></div>
</div>
<div style="clear: both;"></div>
<?php
	endforeach;
}
?>

</div>

</body>
</html>
