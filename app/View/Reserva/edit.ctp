
<form class='form-horizontal well' method='post'>	
	<legend>Editando Usuario</legend>
		<fieldset>
				<div class='control-group'>
					<label class='control-label'>RUT:</label>
					<div class='controls'>
						<input type='text' id='rut_usu' name='rut' value="<?php echo $actual->usu_rut; ?>" required readonly>
					</div>
				</div>
				<div class='control-group'>
					<label for='name' class='control-label'>Nombres:</label>
					<div class='controls'>
						<input type='text' name='nombre' value="<?php echo $actual->usu_nombres; ?>" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Apellidos</label>
					<div class='controls'>
						<input type='text' name='apellido' value="<?php echo $actual->usu_apellido; ?>" required>
					</div>
				</div>
				<div class='control-group'>
					<label class='control-label'>Rol:</label>
					<div class='controls'>
						<select name='rol_id'>
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
				<button class='btn btn-success' type='submit'><i class='icon-share-alt'></i> Guardar</button>
				<button class='btn btn-warning' type='reset'><i class='icon-remove'></i> Cancelar</button>
		</div>
</form>
<script type="text/javascript">
	$("#rut_usu").rut();
</script>