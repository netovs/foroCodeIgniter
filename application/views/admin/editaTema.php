<?php
include('header.php'); 
?>

<h1>Editar tema de foro</h1>
<div class="individual" id="tema-Nuevo">
<?php 
// print_r($temas);
echo form_open('admin/saveTema/' . $temas[0]['id']);
?>
	<!-- 
	<div class="imagenInd" style="width: 285px;">
	<center>Imagen</center>
	<?php echo form_upload('imagen'); ?>
	</div>
	-->
	
	<div class="tituloInd" style="margin: 20px !important; width: 415px;"><label>Tit&uacute;lo: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php 
	echo form_input('titulo', $temas[0]['tema'],'class="inputText"');
	?>
	<?php echo form_error('titulo'); ?>	
	</div>
	<div style="clear:both;"></div>
	
	<div class="tituloInd" style="margin: 20px !important; width: 415px; text-align: left !important;">
	<label>Descripci&oacute;n: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php 
	echo form_input('descripcion', $temas[0]['descripcion'],'class="inputText"');
	?>
	</div>
	<div style="clear:both;"></div>
	
	<div class="tituloInd" style="margin: 20px !important; width: 415px;"><label>Fecha de  publicaci&oacute;n:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php 
	echo form_input('fecha', $temas[0]['fecha'],'class="inputText" id="datepicker"');
	?>
	</div>	
	<div style="clear:both;"></div>
	<div>
	<center>Detalle del tema del foro:</center>
	<?php 
	echo form_textarea('detalle', $temas[0]['texto'] , 'class="tinymce"');
	?>

	</div>
	<div style="clear:both;"></div>
	<div class="herramientasRow">
	<?php 
	echo anchor('admin/listado', 'Cancelar');
	echo form_submit('submit', 'Aceptar', 'class="botonSubmit"');
	?>
	</div>
<?php 
echo form_close();
?>
	
	
	
</div>

<?php
include('footer.php'); 
?>