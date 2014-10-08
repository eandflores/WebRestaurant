<h3>Listado Mesas</h3>
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
<a href="/furaibar/Mesa/add/" class="Agregar">Agregar Mesa</a>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Número de Mesa</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if($Datos!=null){
          foreach ($Datos as $key => $value) {
            echo "<tr>";
              echo "<td>".$value->mes_numero."</td>";
              if($value->mes_estado=='t'){
                  echo "<td>Disponible</td>";
                  }
              else if($value->mes_estado=='f') {
                  echo "<td>Ocupada</td>";
                  }
              echo "<td>";
              echo "<a href='/furaibar/Mesa/eliminar/".$value->mes_id."'><i class='icon-white icon-trash'></i></a>";
              echo "</td>";
            echo "</tr>";
          }
        }
        else{
          echo "<tr>";
            echo "<td colspan='7'>No hay mesas registradas</td>";
          echo "</tr>";
        } ?>
    </tbody>
</table>