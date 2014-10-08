<div class='hero-unit'>
	<h2>Usuario <?php echo $actual->cli_rut; ?></h2>
	<strong>Nombres:</strong> 
	<?php echo $actual->cli_nombre; ?> 
	<br>
	<strong>Apellidos:</strong>
	<?php echo $actual->cli_apellido; ?> 
	<br>
	<strong>Correo:</strong>
	<?php echo $actual->cli_correo; ?> 
	<br>
	<strong>Teléfono:</strong>
	<?php echo $actual->cli_telefono; ?>
	<br>
	<strong>Dirección:</strong>
	<?php echo $actual->cli_direccion; ?>


	<form method="post">
    	<div class="form-actions">
      		<button type="reset" class="btn" onclick="window.location='/furaibar/Cliente/index'">Atras</button>
    	</div>
	</form>
</div>

