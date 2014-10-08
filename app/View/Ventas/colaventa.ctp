<div class='row'>
	<div class='span12'>
		<h3>Cola de Ventas</h3>
		<table class='table table-bordered table-striped table-hover'>
			<thead>
				<tr>
					<th>Número venta</th>
					<th>Mesa</th>
				</tr>
			</thead>
			<tboby>
				<?php 
				$usu = $_SESSION['usuario'];
					if(!empty($emp)){
						foreach ($emp as $key => $value) {
							echo "<tr>";
							echo "<td>".$value->ven_id."</td>";
							echo "<td>".$value->mes_numero."</td>";
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