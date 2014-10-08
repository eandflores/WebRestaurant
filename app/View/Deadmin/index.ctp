<h3>Informe de Ventas</h3>
<form class="form-inline" method="post">
  <select id="selectSucursal" name="selectSucursal" style="display:none">
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
        <th>#</th>
        <th>Rut Cliente</th>
        <th>Total</th>
        <th>Medio de Pago</th>
        <th>Caja</th>
        <th>Mesa</th>
        <th>Fecha</th>
        <th>Sucursal</th>
        <th>Detalle</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if($Ventas!=null){
          foreach ($Ventas as $key => $value) {
      ?>
            <tr>
              <td><?php echo $key+1 ?></td>
              <td><?php echo $value->cli_rut ?></td>
              <td><?php echo $value->ven_total ?></td>
              <td><?php echo $value->ven_mediopago ?></td>
              <td><?php echo $value->caj_nombre ?></td>
              <td><?php echo $value->mes_numero ?></td>
              <td><?php echo $value->ven_fecha ?></td>
              <td><?php echo $value->suc_nombre ?></td>
              <td>
                 <a href="/furaibar/Deadmin/view/<?php echo $value->ven_id ?>"><i class='icon-white icon-search'></i></a>
              </td>
            </tr>
      <?php
          }
        }
        else{
      ?>
          <tr>
            <td colspan='9'>No hay Registros en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>

