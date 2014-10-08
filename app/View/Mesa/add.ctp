<h3>Registro de Mesas</h3>
<form class='form-horizontal well' method='post'>
		<fieldset>
				<div class='control-group'>
					<label class='control-label' for="mes_numero">Numero de Mesa:</label>
					<div class='controls'>
						<input type='number' name='mes_numero' placeholder="0" id='mes_numero' min="0" required>
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
				
			<div class='form-actions'>
				<button type='submit' class='btn btn-success'>
					<i class='icon-user'></i> Guardar
				</button>
				<button type='reset' class='btn btn-warning' onclick="window.location='/furaibar/Personal/index'">
					<i class='icon-remove'></i> Atras
				</button>
			</div>
		</fieldset>
</form>
<script type="text/javascript">
	$("#usu_rut").rut();
</script>