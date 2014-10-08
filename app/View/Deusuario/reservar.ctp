<style>
	.msg-mesas{
		padding-top: 20px;
		padding-bottom: 20px;
	}
</style>
<h3>Realizar reserva</h3>
<form class='form-horizontal well' method='post'  >
	<fieldset>
		<?php $usu = $_SESSION['usuario']; ?>
		<input type="hidden" name="rut" value='<?php echo $usu->cli_rut; ?>'>
		<div class='control-group'>
			<label class='control-label' for="selectSucursal">Sucursal</label>
			<div class='controls'>
				<select name='sucursal' id="sucursal">
					<?php 
						foreach ($sucursal as $key => $value) {
							printf("<option value='%d'>%s</option>\n", $value->suc_id, $value->suc_nombre);
						}
					?>
				</select>
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label' for="selectRol">Fecha</label>
			<div class='controls'>
				<select name='fecha' id="fecha">
					<?php 
						$actual = date('Y-m-d');
						$nueva= date("Y-m-d", strtotime("$actual +7 day"));
						//$miarray = array(); 
						//$c=0;
						while($actual < $nueva){
				    		$actual= date("Y-m-d", strtotime("$actual +1 day"));
				    		$i = strtotime($actual);
				 			$v=jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 );
				 			if($v!=0 && $v!=6 ){?>
				 			
				 				<option value='<?php echo $actual ?>'> <?php echo $actual ?> </option>
							<?php
								//$miarray[$c] = $actual;
								//$c=$c+1;
				 			}
						}			 
					?>
				</select>
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label' for="selectRol">Hora</label>
    		<div class="controls">
          		<select id="hora" name="hora">
                <option  value="10:00:00">10:00</option>
                <option  value="12:00:00">12:00</option>
                <option  value="14:00:00">14:00</option>
                <option  value="16:00:00">16:00</option>
                <option  value="18:00:00">18:00</option>
                <option  value="20:00:00">20:00</option>
                <option  value="22:00:00">22:00</option>
          		</select>
    		</div>
		</div>
	</fieldset>
	<div class='form-actions'>
		<!--<button type='submit' class='btn btn-success'>
			<i class='icon-user'></i> Buscar
		</button>
		<button type='reset' class='btn btn-warning' onclick="window.location='/furaibar/Deusuario/index'">
			<i class='icon-remove'></i> Atras
		</button>-->
		<button type="submit" class="btn btn-success">Seleccionar</button>
	</div>
</form>
<h3>Mesas disponibles</h3>
<?php if($metodo != "GET") { ?>
	<table class='table table-bordered table-striped table-hover'>
		<thead>
			<tr>
				<th>Sucursal</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Mesa</th>
				<th>Reservar</th>	
			</tr>
		</thead>
		<tboby>
			<?php 
				if(!empty($emp)){
					foreach ($emp as $key => $value) {
						$usu   = $_SESSION["usuario"];
						$rut   = $usu->cli_rut;
						$fecha = $value->fecha;
						$hora  = $value->hora;
						$mesa  = $value->mes_id;

						echo "<tr>";
						echo "<td>".$value->suc_nombre."</td>";
						echo "<td>".$fecha."</td>";
						echo "<td>".$hora."</td>";
						echo "<td>".$value->mes_numero."</td>";
						echo "<td>";
						echo "<a class='accion' href='/furaibar/Deusuario/addres/".$mesa."/".$fecha."/".urlencode($hora)."/".$rut."'><i class='icon-white icon-ok'></i></a>";

						echo "</tr>";
					}
				}else{
					echo "<tr><td colspan='6' style='text-align:center;'>No hay mesa disponibles</td></tr>";
				}
			?>

		</tbody>
	</table>
<?php } else{ ?>
	<div id="flashMessage" class="alert alert-warning msg-mesas">
		Debe seleccionar una fecha y hora para la reserva.
	</div>
<?php } ?>
<h3>Reservas realizadas</h3>
<table class='table table-bordered table-striped table-hover'>
	<thead>
		<tr>
			<th>Sucursal</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Mesa</th>
			<th>Estado</th>
			<th>Eliminar</th>	
		</tr>
	</thead>
	<tboby>
		<?php 
			if(!empty($mis)){
				foreach ($mis as $key => $value) {
					echo "<tr>";
					echo "<td>".$value->suc_nombre."</td>";
					echo "<td>".$value->res_fecha."</td>";
					
					echo "<td>".$value->res_hora."</td>";
					echo "<td>".$value->mes_numero."</td>";
					//echo "<td>".$value->res_estado."</td>";

					if($value->res_estado=='t'){
						echo "<td>Aceptada</td>";
					}
					else{ echo "<td>Espera</td>"; }

					echo "<td>";
					echo "<a class='accion' href='/furaibar/Deusuario/deleteres/".$value->res_id."'><i class='icon-white icon-trash'></i></a>";
					echo "</tr>";
				}
			}else{
				echo "<tr><td colspan='6' style='text-align:center;'>No existe un registro de reservas</td></tr>";
			}
		?>
	</tbody>
</table>
