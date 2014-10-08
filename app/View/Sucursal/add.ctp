<h3>Agregar Sucursal</h3>
<form class='form-horizontal well' method='post' name="nombreDelFormulario">
	<fieldset>
		<div class='control-group'>
			<label class='control-label'>Nombre: </label>
			<div class="controls">
				<input id="elnombre" type='text' name='nombre' required placeholder="Nombre" maxlength="15">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Dirección: </label>
			<div class="controls">
				<input id="elnombre" name='direccion' required type="text" placeholder="Dirección" maxlength="30">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Teléfono: </label>
			<div class="controls">
				<input id="eltel" type='number' name='telefono' required max="99999999" placeholder="Teléfono">
			</div>
		</div>
	</fieldset>
	<div class='form-actions'>
		<button type='submit' class='btn btn-success'>Guardar</button>
		<button type="reset" class="btn btn-warning" onclick="window.location='/furaibar/Sucursal'">Atras</button>
	</div>
</form>	