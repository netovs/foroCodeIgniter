<?php 
include('header.php');

?>
<h1>Listado de temas en foro.</h1>
<div class="nuevo">
<?php  
echo anchor('admin/nuevo', '<img border="0" src="' . BASE_URL . '/static/imgs/nuevo.png' . '" align="right" />', 'title="Nuevo tema en foro."');
?>
</div>

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
?>
<div class="individual" id="tema-<?php echo $det['id']; ?>">
	<div class="tituloInd"><?php echo $det['tema']; ?></div>
	<div class="subTituloInd"><?php echo $det['descripcion']; ?></div>
	<div class="fecha"><?php echo $det['fecha']; ?></div>
	<!-- 
	<div class="textoDetalle">
	<?php echo $det['texto']; ?>
	</div>
	-->

	<div class="herramientasRow">
	<?php
	if($det['status'] == 1)
	{ 
		echo anchor('admin/detienePublicacion/' . $det['id'], '<img border="0" src="' . BASE_URL . '/static/imgs/stop.png" align="right" title="Detener publicación" />');
	}
	else
	{
		echo anchor('admin/publicTema/' . $det['id'], '<img border="0" src="' . BASE_URL . '/static/imgs/play.png" align="right" title="Iniciar publicación" />');
	}

	echo anchor('admin/editaTema/' . $det['id'], '<img border="0" src="' . BASE_URL . '/static/imgs/ico_edit.png" align="right" title="Cambiar detalle de publicación" /><br/>');
	?>
	</div>
<div style="clear: both;"></div>
<div style="text-align: right;">
<?php
echo 'Respuestas: <span class="respuesta">' . $this -> listado -> count_respuestas($det['id']) . '</span><br/></div><div class="listaRespuestas">';
if($respuestasDetalle)
{
foreach($respuestasDetalle as $detResp):
	if($det['id'] == $detResp['nuevo_foro_id'])
	{
?>
<b>Nombre: </b><?php echo $detResp['nombre']; ?> <b>Fecha: </b><?php echo $detResp['fecha']; ?> <br/>
<b>e mail:</b> <?php echo $detResp['email']; ?> <br/>
<b>Comentario:</b> <?php echo $detResp['respuesta']; ?> <br/>
<?php
		echo '<img border="0" style="margin: 10px;" src="' . BASE_URL . '/static/imgs/delete.png" align="right" title="Eliminar esta respuesta." onclick="confirmarAlgo(\'eliminaRespuesta/' . $detResp['id'] . '\')" /><br/>'; 
		if($detResp['aprobado'] == 1)
		{
			echo anchor('admin/censuraRespuesta/' . $detResp['id'], '<img border="0" style="margin: 10px;" src="' . BASE_URL . '/static/imgs/stop.png" align="right" title="No aprobar esta respuesta." />');	
		}
		else
		{
			echo anchor('admin/apruebaRespuesta/' . $detResp['id'], '<img border="0" style="margin: 10px;" src="' . BASE_URL . '/static/imgs/apro.png" align="right" title="Aprobar esta respuesta." />'); 
		}
	}
echo '<br/><hr/>'; 
endforeach;
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
<?php 
include('footer.php');
?>