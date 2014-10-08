<form class='form-horizontal well' method='post' name="nombreDelFormulario">
	<legend> Cerrar Venta: </legend>
	<fieldset>
		<?php $usu = $_SESSION['usuario']; ?>
		<input type="hidden" name="su" value='<?php echo $usu->suc_id; ?>' >
		<div class='control-group'>
			<label class='control-label' for="selectSucursal">Venta Mesa:</label>
			<div class='controls'>
				<select name='mesa' id="mesa">
					<?php 
						foreach ($actual as $key => $value) { ?>
							<option value='<?php echo $value->mes_id; ?>'> 
								<?php
								if($value->mes_numero == -1){
									echo "<td>Online</td>";
								}
								else{
									echo "<td>".$value->mes_numero."</td>";
								} ?>
							</option>
					<?php	
						}
					?>
				</select>
			</div>
			<br>	
		</div>
	</fieldset>

	<div class='form-actions'>
		<button type='submit' class='btn btn-success'><i class='icon-ok'></i> OK</button>
		<button type="reset" class="btn" onclick="window.location='/furaibar/Ventas'">Atras</button>
	</div>
</form>
