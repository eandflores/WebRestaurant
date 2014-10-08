<h3>Calcular Remuneración Personal <?php echo date('Y-m-d'); ?></h3>
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
<form method="POST" action="/furaibar/Personal/agregarhoras">
    <table class='table table-bordered table-striped table-hover'>
      <thead>
        <tr>
          <th>#</th>
          <th>Rut</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Rol</th>
          <th>Sucursal</th>
        </tr>
      </thead>
      <tboby>
        <?php 
          if(!empty($emp)){
            foreach ($emp as $key => $value) {
              if($value->sue_estado==null){
                echo "<tr>";
                  echo "<td>";
                    echo "<input type='radio' name='selectUser' value='$value->tra_rut' required>";
                  echo "</td>";
                  echo "<td>".$value->tra_rut."</td>";
                  echo "<td>".$value->tra_nombre."</td>";
                  echo "<td>".$value->tra_apellido."</td>";
                  echo "<td>".$value->rol_nombre."</td>";
                  echo "<td>".$value->suc_nombre."</td>";
                echo "</tr>";
              }
            }
          }else{
            echo "<tr><td colspan='7' style='text-align:center;'>No Hay Registros en la BD</td></tr>";
          }

        ?>
      </tbody>
    </table>
    <div>
        <button type="submit" class="btn btn-primary">Seleccionar</button>
        <button type="reset" class="btn" onclick="window.location='/furaibar/Personal/remuneraciones'">Cancelar</button>
    </div>
</form>