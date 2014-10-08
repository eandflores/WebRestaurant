<h3>Actualizar Menu</h3>
<form class="form-horizontal well" method="post">
    <fieldset>
        <legend>Menu</legend>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="Nombre" value="<?php echo $Elemento[0]->men_nombre ?>" maxlength="50" required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPrecio">Precio</label>
            <div class="controls">
              <input type="number" id="inputPrecio" name="Precio" value="<?php echo $Elemento[0]->men_total ?>" min="0" required>
            </div>
        </div>
            <legend>Productos Menu</legend>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($Productos) && $Productos!=null){
                        $contador=0;
                        foreach ($Productos as $key => $value) {
                            $idProductos[$contador] = $value->pro_id;
                    ?>
                            <tr>
                                <input type="hidden" name="ides[]" value="<?php echo $value->pro_id ?>">
                                <td ><?php echo $value->pro_nombre ?></td>
                                <td >
                                        <input name="cant[]" required type="number" min="0" value="<?php echo $value->pos_cantidad ?>" placeholder="0">
                                </td>
                            </tr>
                    <?php
                        $contador=$contador+1;
                        }
                    }
                    else{
                            $idProductos=null;
                    ?>
                            <tr>
                                <td colspan='6'>No hay Productos en el Menu</td>
                            </tr>
              <?php } ?>
                </tbody>
            </table>   
            <legend>Agregar Productos</legend>
            <div class="control-group warning">
                <label class="control-label" for="selectProductos" style="font-weight:bold">Productos</label>
                <div class="controls">
                    <select id="selectProductos" name="selectProductos">
                        <option>Seleccione un Producto</option>
              <?php if($idProductos!=null){
                        foreach ($ProductosDis as $key => $value){ 
                            if(!in_array($value->pro_id,$idProductos)){ ?>
                                <option value="<?php echo $value->pro_id ?>">
                                    <?php echo $value->pro_nombre ?>
                                </option>        
                      <?php }
                        }
                    }else{
                        foreach ($ProductosDis as $key => $value){ ?>
                            <option value="<?php echo $value->pro_id ?>">
                                <?php echo $value->pro_nombre ?>
                            </option>
                  <?php }
                    } ?>
                    </select>
                    <span class="help-inline" style="font-weight:bold">Seleccione los Productos que desea Agregar.</span>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
              <?php if(isset($ProductosDis) && $ProductosDis!=null){ ?>
                        <tr id="Vacio">
                            <td colspan='6'>Agregue los Productos del Menu</td>
                        </tr>
                  <?php if($idProductos!=null){
                            foreach ($ProductosDis as $key => $value){
                                if(!in_array($value->pro_id,$idProductos)){ ?>
                                    <tr id="<?php echo $value->pro_id ?>" style="display:none">
                                        <td ><?php echo $value->pro_nombre ?></td>
                                        <td ><input name="cantotro[]"  type="number" min="0" value="0"></td>
                                        <input type="hidden" name="idesotro[]" value="<?php echo $value->pro_id ?>">
                                    </tr>
                           <?php }
                            }
                        }else{
                            foreach ($ProductosDis as $key => $value){ ?>
                                <tr id="<?php echo $value->pro_id ?>" style="display:none">
                                    <td ><?php echo $value->pro_nombre ?></td>
                                    <td ><input name="cantotro[]"  type="number" min="0" value="0"></td>
                                    <input type="hidden" name="idesotro[]" value="<?php echo $value->pro_id ?>">
                                </tr>       
                      <?php }
                        }
                    }else{?>
                            <tr>
                                <td colspan='6'>No hay Productos en el Menu</td>
                            </tr>
                  <?php } ?>
                </tbody>
            </table>    
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Siguiente</button>
            <button type="reset" class="btn" onclick="window.location='/furaibar/Menu/index'">Atras</button>
        </div>
    </fieldset>
</form>
<script type="text/javascript">
    $("#selectProductos").change(function() {
        $("#Vacio").attr("style","display:none");
        $("#"+$(this).val()).removeAttr("style"); 
        console.log($(this).val());
    });
</script>