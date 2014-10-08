<h3>Gestión Ingredientes</h3>
<form class="form-inline" method="post" style="display:none">
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
  <button type="submit" class="btn btn-success">Seleccionar</button>
</form>
<a href="/furaibar/Inventario/nuevo/" class="Agregar">Agregar Ingrediente</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Ingrediente</th>
        <th>Stock</th>
        <th>Unidad Medida</th>
        <th>Valor U. Medida</th>
        <th>Valor en Inventario</th>
        <th>Proveedor</th>
        <th>Sucursal</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if($Datos!=null){
          $total=0;
          foreach ($Datos as $key => $value) {
      ?>
            <tr>
              <td><?php echo $value->ing_nombre ?></td>
              <td><?php echo $value->ing_stock ?></td>
              <td><?php echo $value->ing_medida ?></td>
              <td><?php echo "$ ".$value->ing_precio ?></td>
              <?php $total= $total+($value->ing_precio*$value->ing_stock); ?>
              <td><?php echo "$ ".$value->ing_precio*$value->ing_stock ?></td>
              <td><?php echo $value->ing_proveedor ?></td>
              <td><?php echo $value->suc_nombre ?></td>
              <td>
                <a href="/furaibar/Inventario/modificar/<?php echo $value->ing_id ?>" class="accion1"><i class='icon-white icon-arrow-up'></i></a>
                <a href="/furaibar/Inventario/modificar2/<?php echo $value->ing_id ?>" class="accion"><i class='icon-white icon-arrow-down'></i></a>
                <a href="/furaibar/Inventario/eliminar/<?php echo $value->ing_id ?>" class="accion"><i class='icon-white icon-trash'></i></a>
              </td>
            </tr>
    <?php } ?>
          <tr>
            <td colspan="4"></td>
            <td><?php echo  "$ ".$total ?></td>
            <td colspan="3"></td>
          </tr>
  <?php } 
        else{
      ?>
          <tr>
            <td colspan='7'>No hay Ingredientes en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>