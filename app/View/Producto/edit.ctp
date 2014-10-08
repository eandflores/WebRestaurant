<h3>Actualizar Producto </h3>
<form class='form-horizontal well' method='post'>
	<fieldset>
		<div class='control-group'>
			<label class='control-label'>Nombre: </label>
			<div class="controls">
				<input id="elnombre" type='text' name='nombre' required value="<?php echo $producto->pro_nombre; ?>">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Precio: </label>
			<div class="controls">
					<input id="elselect" type='number' name='precio' min="0" required type="text" value="<?php echo $producto->pro_precio; ?>">
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label'>Tiempo de Preparación: </label>
			<div class="controls">
				<input id="elselect" type='number' name='tiempo' min="0" required type="text" value="<?php echo $producto->pro_tiempo; ?>">
			</div>
		</div>
	</fieldset>
	<legend>Ingrdientes: </legend>
	<fieldset>
			<table class='table table-bordered table-striped table-hover'>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th>Medida</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
				<?php if($ingrediente!=null){
					$contador = 0;

					foreach ($ingrediente as $key => $value) {
						$idesingredientes[$contador] = $value->ing_id; ?>

						<tr><input type="hidden" name="ides[]" value="<?php echo $value->ing_id ?>">
							<td ><?php echo $value->ing_nombre ?></td>
							<td ><input id='eliminar' name="cant[]" require type="number" min="0" step="0.001" value="<?php echo $value->con_cantidad ?>"></td>
							<td ><?php echo $value->ing_medida ?></td>
							<td ><input type="checkbox" name="aeliminar[]" value="<?php echo $value->ing_id ?>"></td>
						</tr>
				  <?php $contador = $contador +1;
					}
				}else{ ?>
					<tr>
			            <td colspan='6'>No hay Ingredientes en la Base de Datos</td>
			        </tr>
		  <?php } ?>
				</tbody>
			</table>	
	</fieldset>
	<legend>Agregar Ingredientes: </legend>
	<fieldset>
		<div class="control-group warning">
        	<label class="control-label" for="selectIngredientes" style="font-weight:bold">Ingredientes</label>
	        <div class="controls">
		        <select id="selectIngredientes" name="selectIngredientes">
		        	<option>Seleccione un Ingrediente</option>
		  <?php if($idesingredientes!=null){
					foreach ($ing as $key => $value){ 
						if(!in_array($value->ing_id, $idesingredientes)){ ?>
							<option value="<?php echo $value->ing_id ?>">
				        		<?php echo $value->ing_nombre ?>
				        	</option>        
			      <?php } 
			  		}
			  	}else{
			  		foreach ($ing as $key => $value){ ?>
						<option value="<?php echo $value->ing_id ?>">
			        		<?php echo $value->ing_nombre ?>
			        	</option>        
			  <?php } 
			  	} ?>
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
			if(isset($ing) && $ing!=null){ ?>
				<tr id="Vacio">
			        	<td colspan='6'>Agregue los Ingredientes del Producto</td>
				</tr>
		  <?php if(isset($idesingredientes)){
		  			foreach ($ing as $key => $value){
						if(!in_array($value->ing_id, $idesingredientes)){ ?>
							<tr id="<?php echo $value->ing_id ?>" style="display:none">
								<td ><?php echo $value->ing_nombre ?></td>
								<td ><input id='eliminar' name="cantotro[]"  type="number" min="0" value="0" step="0.001"></td>
								<input type="hidden" name="idesotro[]" value="<?php echo $value->ing_id ?>">
								<td ><?php echo $value->ing_medida ?></td>
							</tr>
				  <?php }
					}
				}else{ 
					foreach ($ing as $key => $value){ ?>
					    <tr id="<?php echo $value->ing_id ?>" style="display:none">
							<td ><?php echo $value->ing_nombre ?></td>
							<td ><input id='eliminar' name="cantotro[]"  type="number" min="0" value="0" step="0.001"></td>
							<input type="hidden" name="idesotro[]" value="<?php echo $value->ing_id ?>">
							<td ><?php echo $value->ing_medida ?></td>
						</tr>
			  <?php }
				}
			}else{ ?>
				<tr>
					<td colspan='6'>No hay Ingredientes en la Base de Datos</td>
				</tr>
	  <?php } ?>
			</tbody>
		</table>	
	</fieldset>
	<div class='form-actions'>
		<button type='submit' class='btn btn-success'><i class='icon-user'></i> Guardar</button>
		<button type="reset" class="btn btn-warning" onclick="window.location='/furaibar/Producto'">Cancelar</button>
	</div>
</form>	
<script type="text/javascript">
	$("#selectIngredientes").change(function() {
		$("#Vacio").attr("style","display:none");
		$("#"+$(this).val()).removeAttr("style"); 
	});
</script>