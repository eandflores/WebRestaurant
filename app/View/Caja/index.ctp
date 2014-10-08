<h3>Listado Cajas</h3>
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
<a href="/furaibar/Caja/add/" class="Agregar">Agregar Caja</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Caja</th>
        <th>Nombre Caja</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if($Datos!=null){
          foreach ($Datos as $key => $value) {
      ?>
            <tr>
              <td><?php echo $value->caj_id ?></td>
              <td><?php echo $value->caj_nombre ?></td>
              <td>
                <a href="/furaibar/Caja/eliminar/<?php echo $value->caj_id ?>" class="accion"><i class='icon-white icon-trash'></i></a>
              </td>
            </tr>
      <?php
          }
        }
        else{
      ?>
          <tr>
            <td colspan='7'>No hay cajas registradas</td>
          </tr>
      <?php } ?>
    </tbody>
</table>