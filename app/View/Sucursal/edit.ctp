<h3>Actualizar Sucursal </h3>
<form class='form-horizontal well' method='post'>
	<fieldset>
		<div class='control-group'>
			<label class='control-label'>Nombre: </label>
			<div class="controls">
				<input id="elnombre" type='text' name='nombre' required value="<?php echo $sucursal->suc_nombre; ?>" maxlength="15">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Dirección: </label>
			<div class="controls">
				<input id="elnombre" name='direccion' required type="text" value="<?php echo $sucursal->suc_direccion; ?>" maxlength="30">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Teléfono: </label>
			<div class="controls">
				<input id="elselect" name='telefono' required type="number" value="<?php echo $sucursal->suc_telefono; ?>" max="99999999">
			</div>
		</div>
	</fieldset>

	<div class='form-actions'>
		<button type='submit' class='btn btn-success'>Guardar</button>
		<button type="reset" class="btn btn-warning" onclick="window.location='/furaibar/Sucursal'">Atras</button>
	</div>
</form>
