<form class='form-horizontal well' method='post'>
			<legend>Creando cliente</legend>
			<fieldset>
				<div class='control-group'>
					<label class='control-label'>RUT:</label>
					<div class='controls'>
						<input type='text' name='rut' id='cli_rut' required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Nombres:</label>
					<div class='controls'>
						<input type='text' name='nombre' required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Apellidos:</label>
					<div class='controls'>
						<input type='text' name='apellidos' required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>correo:</label>
					<div class='controls'>
						<input type='text' name='correo' >
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>telefono:</label>
					<div class='controls'>
						<input type='text' name='telefono' >
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Direccion:</label>
					<div class='controls'>
						<input type='text' name='direccion' >
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Password:</label>
					<div class='controls'>
						<input type='password' name='clave' required id='cli_pass'>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Repita Passowrd:</label>
					<div class='controls'>
						<input type='password' name='clave' id='cli_pass2' required>
					</div>
				</div>
				
			</fieldset>
			<div class='form-actions'>
				<button type='submit' class='btn btn-success'><i class='icon-user'></i> Guardar</button>
				<button type='reset' class='btn btn-warning'><i class='icon-remove'></i> Cancelar</button>
			</div>
</form>
<script type="text/javascript">
	$("#cli_rut").rut();
</script>