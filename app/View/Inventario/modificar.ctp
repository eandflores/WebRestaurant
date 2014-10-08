<h3>Aumentar Stock <?php echo $Elemento[0]->ing_nombre." - Actualmente ".$Elemento[0]->ing_stock." ".$Elemento[0]->ing_medida ?>
</h3>
<?php if(isset($Elemento) && $Elemento!=null)
{
?>
<form class="form-horizontal well" method="post">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="inputPrecio">Precio</label>
            <div class="controls">
              <input type="number" id="inputPrecio" name="Precio2" placeholder="Precio" min="0" required>
              <input type="hidden" name="Precio1" value="<?php echo $Elemento[0]->ing_precio ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="selectMedida">Medida</label>
            <div class="controls">
              <select id="selectMedida" name="selectMedida">
                <?php if($Elemento[0]->ing_medida=="KILO"){ ?>
                <option value="KILO" selected="selected">Kilo</option>
                <option value="GRAMO">Gramo</option>
                <?php } ?>
                <?php if($Elemento[0]->ing_medida=="LITRO"){ ?>
                <option value="LITRO" selected="selected">Litro</option>
                <option value="CC">CC</option>
                <?php } ?>
                <?php if($Elemento[0]->ing_medida=="UNIDAD"){ ?>               
                <option value="UNIDAD" selected="selected">Unidad</option>
                <?php } ?>
              </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputStock">Cantidad a Agregar</label>
            <div class="controls">
              <input type="number" id="inputStock" name="Stock2" placeholder="Cantidad" min="0" step="0.001" required>
            </div>
            <input type="hidden" name="Stock1" value="<?php echo $Elemento[0]->ing_stock ?>">
        </div>
        <input type="hidden" name="Entradas" value="<?php echo $Elemento[0]->ing_entradas ?>">
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <button type="reset" class="btn" onclick="window.location='/furaibar/Inventario/'">Atras</button>
        </div>
    </fieldset>
</form>
<?php } 
else{
?>  
  <form class="form-horizontal well" method="post">
    <div class="form-actions">
      <button type="reset" class="btn" onclick="window.location='/furaibar/Inventario'">Atras</button>
    </div>
  </form>
<?php
}
?>	