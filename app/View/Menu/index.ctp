<h3>Gestión Menus</h3>
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
<a href="/furaibar/Menu/nuevo/" class="Agregar">Agregar Menu</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Valor</th>
        <th>Cantidad de Productos</th>
        <th>Estado</th>
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
              <td><?php echo $value->men_id ?></td>
              <td><?php echo $value->men_nombre ?></td>
              <td><?php echo $value->men_total ?></td>
              <td><?php echo $value->men_cantidad ?></td>
              <?php if($value->men_estado=="t"){ ?>
              <td>Habilitado</td>
              <?php }else{ ?>
              <td>Deshabilitado</td>
              <?php } ?>
              <td><?php echo $value->suc_nombre ?></td>
              <td>
                <a href="/furaibar/Menu/ver/<?php echo $value->men_id ?>" class="accion accion1"><i class='icon-white icon-search'></i></a>
                <a href="/furaibar/Menu/modificar/<?php echo $value->men_id ?>" class="accion"><i class='icon-white icon-pencil'></i></a>
                <?php if($value->men_estado!='t'){ ?>
                  <a href="/furaibar/Menu/enable/<?php echo $value->men_id ?>" class="accion"><i class='icon-white icon-ok'></i></a>
                <?php }else{ ?> 
                  <a href="/furaibar/Menu/eliminar/<?php echo $value->men_id ?>" class="accion"><i class='icon-white icon-remove'></i></a>
                <?php } ?>
              </td>
            </tr>
      <?php
          }
        }
        else{
      ?>
          <tr>
            <td colspan='7'>No hay Promociones en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>