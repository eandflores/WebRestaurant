<h3>Agregar Nueva Caja</h3>
<form class='form-horizontal well' method='post'>
    <fieldset>
        <div class='control-group'>
            <label class='control-label' for="nombre">Nombre Caja</label>
            <div class="controls">
              <input type="text" id='caj_nombre' name=' caj_nombre' placeholder="Nombre" required>
            </div>
        </div>
        <div class='control-group'>
          <label class='control-label' for="selectSucursal">Sucursal</label>
          <div class='controls'>
            <select name='suc_id' id="selectSucursal">
              <?php 
                foreach ($sucursales as $key => $value) {
                  printf("<option value='%d'>%s</option>\n", $value->suc_id, $value->suc_nombre);
                }
              ?>
            </select>
          </div>
        </div>
        <div class="form-actions">
            <button type='submit' class='btn btn-primary'>Agregar</button>
            <button type='reset' class='btn' onclick="window.location='/furaibar/Caja'">Atras</button>
        </div>
    </fieldset>
</form>