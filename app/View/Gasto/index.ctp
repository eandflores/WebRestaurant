<h3>Gestión Gastos</h3>
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
<a href="/furaibar/Gasto/nuevo/" class="Agregar">Agregar Gasto</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Rut Usuario</th>
        <th>ID Caja</th>
        <th>Monto</th>
        <th>Fecha</th>
        <th>Sucursal</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if($Datos!=null){
          foreach ($Datos as $key => $value) {
      ?>
            <tr>
              <td><?php echo $value->gas_id ?></td>
              <td><?php echo $value->tra_rut ?></td>
              <td><?php echo $value->caj_nombre ?></td>
              <td><?php echo $value->gas_monto ?></td>
              <td><?php echo $value->gas_fecha ?></td>
              <td><?php echo $value->suc_nombre ?></td>
              <td>
                <a href="/furaibar/Gasto/eliminar/<?php echo $value->gas_id ?>" class="accion"><i class='icon-white icon-trash'></i></a>
              </td>
            </tr>
      <?php
          }
        }
        else{
      ?>
          <tr>
            <td colspan='7'>No hay Gastos en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>