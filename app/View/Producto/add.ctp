<h3>Agregar Producto: </h3>
<form class='form-horizontal well' method='post' name="nombreDelFormulario">
	<fieldset>
		<div class='control-group'>
			<label class='control-label'>Nombre: </label>
			<div class="controls">
				<input id="elnombre" type='text' name='nombre' required placeholder="Nombre">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Precio: </label>
			<div class="controls">
				<input id="elselect" type='number' name='precio' required min="0" placeholder="Precio">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Tiempo de Preparación: </label>
			<div class="controls">
				<input id="elselect" type='number' name='tiempo' required placeholder="Tiempo de Preparación" step="0.001">
				<span class="help-inline">Minutos</span>
			</div>
		</div>
		<div class="control-group">
            <label class="control-label" for="selectSucursal">Sucursal</label>
            <div class="controls">
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
            </div>
        </div>
	</fieldset>
	<legend>Ingredientes: </legend>
	<fieldset>
	  <div class="control-group warning">
        <label class="control-label" for="selectIngredientes" style="font-weight:bold">Ingredientes</label>
        <div class="controls">
	        <select id="selectIngredientes" name="selectIngredientes">
	        	<option>Seleccione un Ingrediente</option>
			<?php foreach ($ing as $key => $value){ ?>
					<option value="<?php echo $value->ing_id ?>">
		        		<?php echo $value->ing_nombre ?>
		        	</option>        
			<?php } ?>
			</select>
			<span class="help-inline" style="font-weight:bold">Seleccione los Ingredientes que desea Agregar.</span>
		</div>
      </div>
		<table class='table table-bordered table-striped table-hover'>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th>Medida</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			if($ing!=null){ ?>
				  <tr id="Vacio">
			        	<td colspan='6'>Agregue los Ingredientes del Producto</td>
				  </tr>
			<?php foreach ($ing as $key => $value){ ?>
					<tr id="<?php echo $value->ing_id ?>" style="display:none">
						 <td ><?php echo $value->ing_nombre ?></td>
						 <td >
						 	<input id="eliminar" name="cant[]"  type="number" min="0" step="0.001" value="0">
						 </td>
						 <input type="hidden" name="ides[]" value="<?php echo $value->ing_id ?>">
						 <td ><?php echo $value->ing_medida ?></td>
					</tr>
		    <?php }
	  		}else{ ?>
				<tr>
			        <td colspan='6'>No hay Ingredientes en la Base de Datos</td>
				</tr>
	  <?php } ?>
			</tbody>
		</table>	
	</fieldset>		
	<div class='form-actions'>
		<button type='submit' class='btn btn-success'>Guardar Producto</button>
		<button type="reset" class="btn btn-warning" onclick="window.location='/furaibar/Producto'">Atras</button>
	</div>
</form>	
<script type="text/javascript">
	$("#selectIngredientes").change(function() {
		$("#Vacio").attr("style","display:none");
		$("#"+$(this).val()).removeAttr("style"); 
	});
</script>