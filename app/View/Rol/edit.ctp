<h3>Actualizar Rol </h3>
<form class='form-horizontal well' method='post'>
	<fieldset>
		<div class='control-group'>
			<label class='control-label'>Nombre: </label>
			<div class="controls">
				<input id="elnombre" type='text' name='nombre' required value="<?php echo $rol->rol_nombre; ?>">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Sueldo Base: </label>
			<div class="controls">
				<input id="elselect" type='number' name='sueldo' required type="text" value="<?php echo $rol->rol_sueldo_base; ?>">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Sueldo por Hora: </label>
			<div class="controls">
				<input id="elselect2" type='number' name='sueldo2' required type="text" value="<?php echo $rol->rol_sueldo_hora; ?>">
			</div>
		</div>
	</fieldset>
	<div class='form-actions'>
		<button type='submit' class='btn btn-success'>Guardar</button>
		<button type="reset" class="btn btn-warning" onclick="window.location='/furaibar/Rol'">Atras</button>
	</div>
</form>	
