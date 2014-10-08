<h3>Gestión Ingredientes</h3>
<form class="form-inline" method="post">
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
<a href="/furaibar/Pedido/nuevo/" class="Agregar">Agregar Pedido</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Mesa</th>
        <th>Hora</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if($Datos!=null){
          foreach ($Datos as $key => $value) {
      ?>
            <tr>
              <td><?php echo $value->ped_id ?></td>
              <td><?php echo $value->mes_numero ?></td>
              <td><?php echo $value->ped_hora ?></td>
              <td><?php echo $value->ped_total ?></td>
              <td>
                <a href="/furaibar/Pedido/modificar/<?php echo $value->ing_id ?>" class="accion1"><i class='icon-white icon-pencil'></i></a>
                <a href="/furaibar/Pedido/eliminar/<?php echo $value->ing_id ?>" class="accion"><i class='icon-white icon-trash'></i></a>
              </td>
            </tr>
      <?php
          }
        }
        else{
      ?>
          <tr>
            <td colspan='4'>No hay Ingredientes en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>