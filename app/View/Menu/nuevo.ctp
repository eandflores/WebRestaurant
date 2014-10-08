<h3>Agregar Menu</h3>
<form class="form-horizontal well" method="post">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="Nombre" placeholder="Nombre" maxlength="50" required>
            </div>
        </div> 
        <div class="control-group">
            <label class="control-label" for="inputPrecio">Precio</label>
            <div class="controls">
              <input type="number" id="inputPrecio" name="Precio" placeholder="Precio" min="0" required>
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
    </fieldset>
    <legend>Productos: </legend>
    <fieldset>
      <div class="control-group warning">
        <label class="control-label" for="selectIngredientes" style="font-weight:bold">Productos</label>
        <div class="controls">
            <select id="selectProductos" name="selectProductos">
                  <option>Seleccione un Producto</option>
            <?php foreach ($Producto as $key => $value){ ?>
                    <option value="<?php echo $value->pro_id ?>">
                        <?php echo $value->pro_nombre ?>
                    </option>        
            <?php } ?>
            </select>
            <span class="help-inline" style="font-weight:bold">Seleccione los Productos que desea Agregar.</span>
        </div>
      </div>
        <table class='table table-bordered table-striped table-hover'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>                
                </tr>
            </thead>
            <tbody>
            <?php 
            if($Producto!=null){ ?>
                  <tr id="Vacio">
                        <td colspan='6'>Agregue los Productos del Menu</td>
                  </tr>
            <?php foreach ($Producto as $key => $value){ ?>
                    <tr id="<?php echo $value->pro_id ?>" style="display:none">
                         <td ><?php echo $value->pro_nombre ?></td>
                         <td >
                            <input id="eliminar" name="cant[]"  type="number" min="0" value="0">
                         </td>
                         <input type="hidden" name="ides[]" value="<?php echo $value->pro_id ?>">
                    </tr>
            <?php }
            }else{ ?>
                <tr>
                    <td colspan='6'>No hay Productos en la Base de Datos</td>
                </tr>
      <?php } ?>
            </tbody>
        </table>    
    </fieldset>     
    <div class='form-actions'>
        <button type='submit' class='btn btn-success'>Guardar Producto</button>
        <button type="reset" class="btn btn-warning" onclick="window.location='/furaibar/Menu'">Atras</button>
    </div>
</form> 
<script type="text/javascript">
    $("#selectProductos").change(function() {
        $("#Vacio").attr("style","display:none");
        $("#"+$(this).val()).removeAttr("style"); 
    });
</script>
</form>