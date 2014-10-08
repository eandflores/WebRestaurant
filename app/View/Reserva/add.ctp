<h3>Registro de Reserva</h3>
<form class='form-horizontal well' method='post'>
		<fieldset>
				

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
					<label class='control-label' for="inpuNombre">Mesa:</label>
					<div class='controls'>
						<input type='text' id="inputNombre" name='nombre' placeholder="Nombre" required>
					</div>
				</div>
				
				<div class='control-group'>
					<label class='control-label' for="inpuNombre">Dia:</label>
					<div class='controls'>
						<input type='text' id="inputNombre" name='nombre' placeholder="Nombre" required>
					</div>
				</div>
				

				
			</fieldset>
			<div class='form-actions'>
				<button type='submit' class='btn btn-success'><i class='icon-user'></i> Guardar</button>
				<button type='reset' class='btn btn-warning'><i class='icon-remove'></i> Cancelar</button>
			</div>
</form>
<script type="text/javascript">
	$("#usu_rut").rut();
</script>