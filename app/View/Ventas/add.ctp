<h3>Opciones de Compra</h3>
<form method="post" class="form-horizontal well" action="/furaibar/Ventas/add2/">
	<div class="control-group">
        <label class="control-label" for="selectSucursal">Sucursal</label>
        <div class="controls">
          	<select id="selectSucursal" name="sucursal">
          		<?php 
		    		if($Datos_sucursal!=null){
		        		foreach ($Datos_sucursal as $key => $value) {
				?>
                <option value="<?php echo $value->suc_id ?>"><?php echo $value->suc_nombre ?></option>
                <?php
            			}
            		}
            	?>
          	</select>
        </div>
    </div>
	  <div class="control-group">
        <label class="control-label" for="selectPago">Medio de pago</label>
        <div class="controls">
          	<select id="selectPago" name="mediodepago">
                <option value="EFECTIVO">Efectivo</option>
                <option value="CHEQUE">Cheque</option>
                <option value="TARJETA">Tarjeta</option>
          	</select>
        </div>
    </div>
    <div class='control-group'>
        <label class='control-label' for="selectRut">Rut Cliente</label>
        <div class='controls'>
          <select id="selectRut" name='cliente' >
            <option value="">
                      Sin Cliente
            <?php foreach ($Clientes as $key => $value) { ?>
                    <option value="<?php echo $value->cli_rut ?>">
                      <?php echo $value->cli_rut ?>
                    </option>
            <?php } ?>
          </select>
        </div>
    </div>
    <div class="form-actions">
	        <button class="btn btn-primary" type="submit">Siguiente</button>
	        <button class="btn" type="reset" onclick="window.location='/furaibar/Ventas'">Cancelar</button>
        </div>
</form>