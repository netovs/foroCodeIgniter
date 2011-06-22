<?php
include('header.php');
if(isset($error))
{
?>
<div class="error">
<?php
	echo $error;
?>
</div>
<?php
}
?>
<div class="loginBox">
<?php 
echo form_open('admin/verify');
?>
	<div style="float: left; width: 100px;">Usuario:</div>
	<div style="float: right; width: 120px;">
	<input type="text" name="username" class="inputText" />
	</div>
	<div style="clear: both;"></div>
	<div style="float: left; width: 100px;">Password:</div>
	<div style="float: right; width: 120px;" >
		<input type="password" name="password" class="inputText" />
	</div>
	<div style="clear: both;"></div>
	<div style="float: left; width: 300px;"></div>
	<div style="float: right; width: 0px;">
<?php
$attribs = array('name' => 'submit', 'value' => 'Entrar', 'class' => 'botonSubmit');
echo form_submit($attribs);
?>
	</div>
<?php 
echo form_close();
?>
	<div style="clear: both;"></div>

</div>

<?php include('footer.php'); ?>