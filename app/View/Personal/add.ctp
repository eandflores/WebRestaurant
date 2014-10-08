<h3>Registro de Usuario</h3>
<form class='form-horizontal well' method='post'>
		<fieldset>
				<div class='control-group'>
					<label class='control-label' for="usu_rut">Rut:</label>
					<div class='controls'>
						<input type='text' name='rut' placeholder="Rut" id='usu_rut' maxlength="12" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inpuNombre">Nombres:</label>
					<div class='controls'>
						<input type='text' id="inputNombre" name='nombre' placeholder="Nombre" maxlength="30" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inpuApellido">Apellidos:</label>
					<div class='controls'>
						<input type='text' id="inputApellido" name='apellidos' placeholder="Apellido" maxlength="20" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="usu_pass">Password:</label>
					<div class='controls'>
						<input type='password' name='clave' placeholder="Password" required id='usu_pass' maxlength="10">
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="usu_pass2">Repetir Password:</label>
					<div class='controls'>
						<input type='password' name='clave' placeholder="Repetir Password" id='usu_pass2' maxlength="10" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inpuTelefono">Teléfono:</label>
					<div class='controls'>
						<input type='number' id="inputTelefono" name='telefono' placeholder="Teléfono" max="99999999" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inpuCorreo">Correo:</label>
					<div class='controls'>
						<input type='email' id="inputCorreo" name='correo' placeholder="Correo" maxlength="30" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inputDireccion">Dirección:</label>
					<div class='controls'>
						<input type='text' name='direccion' placeholder="Dirección" required id='inputDireccion' maxlength="40">
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="selectSucursal">Sucursal</label>
					<div class='controls'>
						<select name='suc_id' id="selectSucursal">
							<?php 
								foreach ($sucursales as $key => $value) {
									printf("<option value='%d'>%s</option>\n", $value->suc_id, $value->suc_nombre);
								}
							?>
						</select>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="selectRol">Rol:</label>
					<div class='controls'>
						<select name='rol_id' id="selectRol">
							<?php 
								foreach ($roles as $key => $value) {
									printf("<option value='%d'>%s</option>",$value->rol_id, $value->rol_nombre);
								}
							?>
						</select>
					</div>
				</div>
			</fieldset>
			<div class='form-actions'>
				<button type='submit' class='btn btn-success'>
					<i class='icon-user'></i> Guardar
				</button>
				<button type='reset' class='btn btn-warning' onclick="window.location='/furaibar/Personal/index'">
					<i class='icon-remove'></i> Atras
				</button>
			</div>
</form>
<script type="text/javascript">
	$("#usu_rut").rut();
</script>