
<form class='form-horizontal well' method='post'>	
	<legend>Editando cliente</legend>
		<fieldset>
				<div class='control-group'>
					<label class='control-label'>RUT:</label>
					<div class='controls'>
						<input type='text' id='rut_cli' name='rut' value="<?php echo $actual->cli_rut; ?>" required readonly>
					</div>
				</div>
				<div class='control-group'>
					<label for='name' class='control-label'>Nombres:</label>
					<div class='controls'>
						<input type='text' name='nombre' value="<?php echo $actual->cli_nombre; ?>" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Apellidos</label>
					<div class='controls'>
						<input type='text' name='apellido' value="<?php echo $actual->cli_apellido; ?>" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>correo</label>
					<div class='controls'>
						<input type='text' name='correo' value="<?php echo $actual->cli_correo; ?>" >
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>telefono</label>
					<div class='controls'>
						<input type='text' name='telefono' value="<?php echo $actual->cli_telefono; ?>" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>direccion</label>
					<div class='controls'>
						<input type='text' name='direccion' value="<?php echo $actual->cli_direccion; ?>" required>
					</div>
				</div>
				
		</fieldset>
		<div class='form-actions'>
				<button class='btn btn-success' type='submit'><i class='icon-share-alt'></i> Guardar</button>
				<button class='btn btn-warning' type='reset'><i class='icon-remove'></i> Cancelar</button>
		</div>
</form>
<script type="text/javascript">
	$("#rut_cli").rut();
</script>