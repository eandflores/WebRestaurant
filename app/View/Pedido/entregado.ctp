
<form class='form-horizontal well' method='post' name="nombreDelFormulario">
			<legend> FINALIZAR PEDIDO: </legend>
			<fieldset>
				<?php $usu = $_SESSION['usuario']; ?>
				<!--<input type="hidden" name="su" value='<?php //echo $usu->suc_id; ?>' >-->
				<input type="hidden" name="su" value='<?php echo $usu->suc_id; ?>' >
				<div class='control-group'>
					<!--<input type="hidden" name="su" value="1" > <!--sucursal 1 =concepcion-->

					<label class='control-label' for="selectSucursal">Numero de Mesa</label>
							<div class='controls'>
								<select name='pedido' id="pedido">
									<?php 
										foreach ($actual as $key => $value) {
		printf("<option value='%d'>mesa %d- pedido %d</option>\n",$value->ped_id,$value->mes_numero,$value->ped_id);
										
										}
									?>
								</select>
							</div>
					<br>
					
				</div>
			</fieldset>

			<div class='form-actions'>
				<button type='submit' class='btn btn-success'><i class='icon-ok'></i> OK</button>
				<!--<button type='reset' class='btn btn-warning'><i class='icon-remove'></i> Cancelar</button>
				<button type="reset" class="btn" onclick="window.location='/furaibar/Ventas'">Atras</button>-->
			</div>
</form>
