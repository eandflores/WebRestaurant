<?php 
if(isset($Venta) && $Venta!=null){ ?>
<form class="form-horizontal well" method="post" class="Vista">
    <fieldset>
        <legend>Venta: <?php echo $Venta[0]->ven_id ?></legend>
        <div class="control-group">
            <label class="control-label" for="inputRut">Rut Cliente</label>
            <div class="controls">
              <input type="text" id="inputRut" name="Rut" value="<?php echo $Venta[0]->cli_rut ?>" required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputTotal">Total</label>
            <div class="controls">
              <input type="text" id="inputTotal" name="Total" value="<?php echo $Venta[0]->ven_total ?>"required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputMedio">Medio de Pago</label>
            <div class="controls">
              <input type="text" id="inputMedio" name="Medio" value="<?php echo $Venta[0]->ven_mediopago ?>"required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputCaja">Caja</label>
            <div class="controls">
              <input type="text" id="inputCaja" name="Caja" value="<?php echo $Venta[0]->caj_nombre ?>"required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputMesa">Mesa</label>
            <div class="controls">
              <input type="text" id="inputMesa" name="Medio" value="<?php echo $Venta[0]->mes_numero ?>"required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputFecha">Fecha</label>
            <div class="controls">
              <input type="text" id="inputFecha" name="Fecha" value="<?php echo $Venta[0]->ven_fecha ?>" required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputSucursal">Sucursal</label>
            <div class="controls">
              <input type="text" id="inputSucursal" name="Sucursal" value="<?php echo $Venta[0]->suc_nombre ?>"required readonly>
            </div>
        </div>
        <?php if(isset($Menus) && $Menus!=null){ ?>
          <div class="control-group">
            <legend>Menus</legend>
            <div style="padding:30px 0px 0px 90px;">
            <table class="TablaPromos">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($Menus as $key => $value){ ?>
                        <tr>
                            <td ><?php echo $value->men_nombre ?></td>
                            <td >
                                <div class="control-group">
                                    <input class="cuadrado" name="cant[]" required readonly type="text" value="<?php echo $value->men_total ?>" placeholder="0">
                                </div>
                            </td>
                        </tr>
              <?php } ?>
                </tbody>
            </table>    
            </div>
          </div>
  <?php } ?>
        <?php if(isset($Productos) && $Menus!=null){ ?>
          <div class="control-group">
            <legend>Productos</legend>
            <div style="padding:30px 0px 0px 90px;">
            <table class="TablaPromos">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($Productos as $key => $value){ ?>
                        <tr>
                            <td ><?php echo $value->pro_nombre ?></td>
                            <td >
                                <div class="control-group">
                                    <input class="cuadrado" name="cant[]" required readonly type="text" value="<?php echo $value->pro_precio ?>" placeholder="0">
                                </div>
                            </td>
                        </tr>
              <?php } ?>
                </tbody>
            </table>    
            </div>
          </div>
  <?php } ?>
        <div class="form-actions">
            <button type="reset" class="btn" onclick="window.location='/furaibar/Menu/index'">Atras</button>
        </div>
    </fieldset>
</form>
<?php 
}
else{
?>  
  <form class="form-horizontal well" method="post">
    <div class="form-actions">
      <button type="reset" class="btn" onclick="window.location='/furaibar/Deadmin/'">Atras</button>
    </div>
  </form>
<?php } ?>	