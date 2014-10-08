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
		<h3>Listado de clientes</h3>

		<a href="/furaibar/Cliente/add/" class="Agregar">Agregar cliente</a>
		<table class='table table-bordered table-striped table-hover'>
			<thead>
				<tr>
					<th>RUT</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Correo</th>
					<th>Telefono</th>
					<th>Direccion</th>
					<!--<th>Password</th>-->
					<th>Operaciones</th>
				</tr>
			</thead>
			<tboby>
				<?php 
					if(!empty($emp)){
						foreach ($emp as $key => $value) {
							echo "<tr>";
							echo "<td>".$value->cli_rut."</td>";
							echo "<td>".$value->cli_nombre."</td>";
							echo "<td>".$value->cli_apellido."</td>";
							echo "<td>".$value->cli_correo."</td>";
							echo "<td>".$value->cli_telefono."</td>";
							echo "<td>".$value->cli_direccion."</td>";
							//echo "<td>".$value->cli_password."</td>";
							echo "<td>";
							echo "<a href='/furaibar/Cliente/view/".$value->cli_rut."'><i class='icon-white icon-search'></i></a>";
							echo "<a href='/furaibar/Cliente/edit/".$value->cli_rut."'><i class='icon-white icon-pencil'></i></a>";
							echo "<a href='/furaibar/Cliente/eliminar/".$value->cli_rut."'><i class='icon-white icon-trash'></i></a>"; 
							/*echo "<a href='#' data-toggle='modal' data-target='#addModal' ><i class='icon-white icon-trash'></i></a>"; ?>
								<!-- MODAL -->
								<div id="addModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-header">
								    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								    <h3 id="myModalLabel">Desea eliminar cliente <?php echo $value->cli_rut ?></h3>
								  </div>
								  <div class="modal-body">
								    <form class="form-horizontal" method="post" action="">
								      
								  <div class="modal-footer">
								    <a class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</a>
								    <button type="submit" class="btn btn-primary">Buscar</button>
								    <!--<a id="save" href="historial.php" class="btn btn-primary">Buscar</a>-->
								  </div>
								    </form>
								      </div>
								</div>
								<!-- fin modal-->
							<?php*/
							echo "</tr>";
						}
					}else{
						echo "<tr><td colspan='7' style='text-align:center;'>SIN REGISTROS EN LA BASE DE DATOS</td></tr>";
					}

				?>
			</tbody>
		</table>
	</div>
</div>