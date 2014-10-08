<h3>Remuneraciones Personal</h3>
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
  <input type="date" class="input-default" placeholder="Fecha" name="Fecha" value="<?php 
    if(isset($Fecha))
      echo $Fecha;
    else
      echo date('Y-m-d'); ?>">
  <button type="submit" class="btn btn-success">Seleccionar</button>
</form>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Rut</th>
        <th>Nombre</th>
        <th>Sucursal</th>
        <th>Horas Trabajadas</th>
        <th>Monto por Hora</th>
        <th>Total</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if($Sueldos!=null){
          foreach ($Sueldos as $key => $value) {
      ?>
            <tr>
              <td><?php echo $value->tra_rut ?></td>
              <td><?php echo $value->tra_nombre." ".$value->tra_apellido ?></td>
              <td><?php echo $value->suc_nombre ?></td>
              <td><?php echo $value->sue_horas_trab ?></td>
              <td><?php echo $value->rol_sueldo_base ?></td>
              <td><?php echo $value->sue_horas_trab*$value->rol_sueldo_base ?></td>
              <td><?php echo $value->sue_fecha_pago ?></td>
            </tr>
      <?php
          }
        }
        else{
      ?>
          <tr>
            <td colspan='7'>No hay Registros en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>

