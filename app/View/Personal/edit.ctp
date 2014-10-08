<h3>Editar Usuario <?php echo $actual->tra_rut; ?></h3>
<form class='form-horizontal well' method='post'>	
		<fieldset>
				<input type="hidden" name="rut" value="<?php echo $actual->tra_rut; ?>">
				<div class='control-group'>
					<label class='control-label' for="inputNombre">Nombres:</label>
					<div class='controls'>
						<input type='text' id="inputNombre" name='nombre' value="<?php echo $actual->tra_nombre; ?>" maxlength="30" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inputApellido">Apellidos</label>
					<div class='controls'>
						<input type='text' id="inputApellido" name='apellido' value="<?php echo $actual->tra_apellido; ?>" maxlength="20" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inpuTelefono">Teléfono:</label>
					<div class='controls'>
						<input type='number' id="inputTelefono" name='telefono' value="<?php echo $actual->tra_telefono; ?>" max="99999999" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inpuCorreo">Correo:</label>
					<div class='controls'>
						<input type='email' id="inputCorreo" name='correo' value="<?php echo $actual->tra_correo; ?>" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label' for="inputDireccion">Dirección:</label>
					<div class='controls'>
						<input type='text' name='direccion' value="<?php echo $actual->tra_direccion; ?>" required id='inputDireccion' maxlength="40">
					</div>
				</div>

				<div class='control-group'>
					<label class='control-label' for="selectRol">Rol:</label>
					<div class='controls'>
						<select name='rol_id' id="selectRol">
							<?php 

								foreach ($roles as $key => $value) {
									if($actual->rol_id == $value->rol_id)
										printf("<option value='%d' selected>%s</option>\n",$value->rol_id,$value->rol_nombre);
									else
										printf("<option value='%d'>%s</option>\n",$value->rol_id,$value->rol_nombre);
								}
							?>
						</select>
					</div>
				</div>
		</fieldset>
		<div class='form-actions'>
				<button class='btn btn-success' type='submit'>
					<i class='icon-share-alt'></i> Guardar
				</button>
				<button class='btn btn-warning' type='reset' onclick="window.location='/furaibar/Personal/index'">
					<i class='icon-remove'></i> Cancelar
				</button>
		</div>
</form>
<script type="text/javascript">
	$("#rut_usu").rut();
</script>