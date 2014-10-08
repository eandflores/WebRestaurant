<h3>Calcular Remuneración</h3>
<?php if($emp!=null)
{
?>
<form class="form-horizontal well" method="post" action="/furaibar/Personal/calcularremuneracion">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="inputRut">Rut</label>
            <div class="controls">
              <input type="text" id="inputRut" name="Rut" value="<?php echo $emp[0]->tra_rut ?>" maxlength="50" required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputNombre">Nombre</label>
            <div class="controls">
              <input type="text" id="inputNombre" name="Nombre" value="<?php echo $emp[0]->tra_nombre." ".$emp[0]->tra_apellido ?>" maxlength="50" required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputSueldo">Sueldo por Hora</label>
            <div class="controls">
              <input type="number" id="inputSueldo" name="Sueldo" value="<?php echo $emp[0]->rol_sueldo_base ?>" min="0" required readonly>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputHoras">Horas Trabjadas</label>
            <div class="controls">
              <input type="number" id="inputHoras" name="Horas" value="0" min="0" required>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Calcular</button>
            <button type="reset" class="btn" onclick="window.location='/furaibar/Personal/remuneraciones'">Atras</button>
        </div>
    </fieldset>
</form>
<?php } 
else{
?>  
  <form class="form-horizontal well" method="post">
    <div class="form-actions">
      <button type="reset" class="btn" onclick="window.location='/furaibar/Personal/remuneraciones'">Atras</button>
    </div>
  </form>
<?php
}
?>	