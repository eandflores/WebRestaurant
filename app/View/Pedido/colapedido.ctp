<div class='row'>
	<div class='span12'>
		<h3>Cola de Pedidos</h3>

		<!--<a href="/furaibar/Personal/add/" class="Agregar">Agregar Empleado</a>-->
		<table class='table table-bordered table-striped table-hover'>
			<thead>
				<tr>
					<th>Numero</th>
					<th>Hora</th>
					<th>Mesa</th>
					<!--<th>Entregado</th>-->
				</tr>
			</thead>
			<tboby>
				<?php 
				//$usu = $_SESSION['usuario'];
					if(!empty($emp)){
						foreach ($emp as $key => $value) {
							$nuevafecha = strtotime ( '+2 hour' , strtotime ( $value->ped_hora ) ) ;
							$nuevafecha = date ( 'H:i' , $nuevafecha );

							echo "<tr>";
							echo "<td>".$value->ped_id."</td>";
							echo "<td>".$nuevafecha."</td>";
							//echo "<td>".$value->ped_hora."</td>";
							echo "<td>".$value->mes_numero."</td>";
							
							//echo "<a href='/furaibar/Pedido/entregado'><i class='icon-white icon-ok'></i></a>";
							 
							
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