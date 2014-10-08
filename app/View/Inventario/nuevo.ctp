<h3>Agregar Nuevo Ingrediente</h3>
<form class="form-horizontal well" method="post">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="Nombre" placeholder="Nombre" maxlength="15" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPrecio">Precio</label>
            <div class="controls">
              <input type="number" id="inputPrecio" name="Precio" placeholder="Precio" min="0" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectMedida">Medida</label>
            <div class="controls">
              <select id="selectMedida" name="selectMedida">
                <option value="UNIDAD" selected="selected">Unidad</option>
                <option value="KILO">Kilo</option>
                <option value="GRAMO">Gramo</option>
                <option value="LITRO">Litro</option>
                <option value="CC">CC</option>
              </select>
            </div>
        </div>        
        <div class="control-group">
            <label class="control-label" for="inputStock">Stock</label>
            <div class="controls">
              <input type="number" id="inputStock" name="Stock" placeholder="Stock" min="0" step="0.001" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputProveedor">Proveedor</label>
            <div class="controls">
              <input type="text" id="inputProveedor" name="Proveedor" placeholder="Proveedor" maxlength="20" required>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectSucursal">Sucursal</label>
            <div class="controls">
              <select id="selectSucursal" name="selectSucursal">
                <?php if(isset($Sucursal) && $Sucursal!=null){
                        foreach ($Sucursal as $key => $value) {
                          if($key==0){ ?>
                            <option value="<?php echo $value->suc_id ?>" selected="selected"><?php echo $value->suc_nombre ?></option>
                    <?php }
                          else{ ?>
                            <option value="<?php echo $value->suc_id ?>"><?php echo $value->suc_nombre ?></option>
                    <?php } 
                        }
                      }?>
              </select>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Agregar</button>
            <button type="reset" class="btn" onclick="window.location='/furaibar/Inventario'">Atras</button>
        </div>
    </fieldset>
</form>