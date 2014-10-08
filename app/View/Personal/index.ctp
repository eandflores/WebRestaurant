<div class='row'>
	<div class='span12'>
		<h3>Listado Personal</h3>
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
		<a href="/furaibar/Personal/add/" class="Agregar">Agregar Empleado</a>
		<table class='table table-bordered table-striped table-hover'>
			<thead>
				<tr>
					<th>Rut</th>
					<th>Nombre</th>
					<th>Estado</th>
					<th>Rol</th>
					<th>Sucursal</th>
					<th>Operaciones</th>
				</tr>
			</thead>
			<tboby>
				<?php 
					if(!empty($emp)){
						foreach ($emp as $key => $value) {
							echo "<tr>";
							echo "<td>".$value->tra_rut."</td>";
							echo "<td>".$value->tra_nombre." ".$value->tra_apellido."</td>";
							if($value->tra_estado=='t')
							echo "<td>Habilitado</td>";
							else
							echo "<td>Deshabilitado</td>";
							echo "<td>".$value->rol_nombre."</td>";
							echo "<td>".$value->suc_nombre."</td>";
							echo "<td>";
							echo "<a class='accion1' href='/furaibar/Personal/view/".$value->tra_rut."'><i class='icon-white icon-search'></i></a>";
							echo "<a class='accion' href='/furaibar/Personal/edit/".$value->tra_rut."'><i class='icon-white icon-pencil'></i></a>";
							if($value->tra_estado=='f'){
								echo "<a class='accion' href='/furaibar/Personal/enable/".$value->tra_rut."'><i class='icon-white icon-ok'></i></a>";
							}else{
								echo "<a class='accion' href='/furaibar/Personal/eliminar/".$value->tra_rut."'><i class='icon-white icon-remove'></i></a>";
							}
							echo "</tr>";
						}
					}else{
						echo "<tr><td colspan='6' style='text-align:center;'>SIN REGISTROS EN LA BASE DE DATOS</td></tr>";
					}

				?>
			</tbody>
		</table>
	</div>
</div>