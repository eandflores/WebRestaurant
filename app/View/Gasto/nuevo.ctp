<h3>Agregar Gasto</h3>
<form class="form-horizontal well" method="post">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="selectRut">Rut Usuario</label>
            <div class="controls">
              <select id="selectRut" name="selectRut">
                <?php if(isset($Rut) && $Rut!=null){
                        foreach ($Rut as $key => $value) {
                          if($key==0){ ?>
                            <option value="<?php echo $value->tra_rut ?>" selected="selected"><?php echo $value->tra_rut ?></option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $value->tra_rut ?>"><?php echo $value->tra_rut ?></option>
                    <?php } 
                        }
                      }?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectCaja">Caja Sucursal</label>
            <div class="controls">
              <select id="selectCaja" name="selectCaja">
                <?php if(isset($Caja) && $Caja!=null){
                        foreach ($Caja as $key => $value) {
                          if($key==0){ ?>
                            <option value="<?php echo $value->caj_id ?>" selected="selected"><?php echo $value->caj_id ?></option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $value->caj_id ?>"><?php echo $value->caj_id ?></option>
                    <?php } 
                        }
                      }?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputMonto">Monto</label>
            <div class="controls">
              <input type="number" id="inputMonto" name="Monto" placeholder="Monto" min="0" step="0.1" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectMotivo">Motivo</label>
            <div class="controls">
              <input type="text" id="inputMotivo" name="Motivo" placeholder="Motivo" maxlength="50">
            </div>
        </div>        
          <input type="hidden" name="Fecha" value="<?php echo date("Y-m-d") ?>"> 
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Agregar</button>
            <button type="reset" class="btn" onclick="window.location='/furaibar/Gasto/index'">Cancelar</button>
        </div>
    </fieldset>
</form>