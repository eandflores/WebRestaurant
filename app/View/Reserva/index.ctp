<style type="text/css">
	i{
		margin-left: 10px;
	}
	.table{
		width:880px;
	}

</style>
<div class='row'>
	<div class='span12'>
		<h3>Listado Reserva</h3>
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

		<!--<a href="/furaibar/Personal/add/" class="Agregar">Agregar Empleado</a>-->
		<table class='table table-bordered table-striped table-hover'>
			<thead>
				<tr>
					<th>Fecha</th>
					<th>estado</th>
					<th>N° mesa</th>
					<th>Operacion</th>
				</tr>
			</thead>
			<tboby>
				<?php 
					if(!empty($emp)){
						foreach ($emp as $key => $value) {
							echo "<tr>";
							$nuevafecha = strtotime ( '+1 hour' , strtotime ( $value->res_fecha ) ) ;
							$nuevafecha = date ( 'Y-m-j H:i' , $nuevafecha );
							echo "<td>".$nuevafecha."</td>";
							//echo "<td>".$value->res_fecha."</td>";
							if($value->res_estado == 't'){
							 echo "<td>Aceptada</td>";
							}else{
								echo "<td>Espera</td>";
							}
							//echo "<td>".$value->res_estado."</td>";
							echo "<td>".$value->mes_numero."</td>";
							echo "<td>";
							if($value->res_estado == 'f'){
								echo "<a href='/furaibar/Reserva/acep/".$value->res_id."'><i class='icon-white icon-ok'></i></a>";	
							}
							echo "<a href='/furaibar/Reserva/view/".$value->res_id."'><i class='icon-white icon-search'></i></a>";
							//echo "<a href='/furaibar/Reserva/edit/".$value->mes_id."'><i class='icon-white icon-pencil'></i></a>";
							echo "<a href='/furaibar/Reserva/eliminar/".$value->res_id."'><i class='icon-white icon-trash'></i></a>";
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