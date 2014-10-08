<h3>Listado Sucursales</h3>
<a href="sucursal/add" class="Agregar">Agregar sucursal</a>
<table class='table table-bordered table-striped table-hover'>
	<thead>
		<tr>
			<th id="nombre">Nombre</th>
			<th id="precio">Dirección</th>
			<th>Teléfono</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tboby>
    <?php if(!empty($suc)){
			foreach ($suc as $key => $value) {
				echo "<tr>";
				echo "<td>".$value->suc_nombre."</td>";
				echo "<td>".$value->suc_direccion."</td>";
				echo "<td>".$value->suc_telefono."</td>";
				echo "<td>";
				echo "<a class='accion accion1' href='sucursal/view/".$value->suc_id."'><i class='icon-white icon-search'></i></a>";
				echo "<a class='accion' href='sucursal/edit/".$value->suc_id."'><i class='icon-white icon-pencil'></i></a>";
				echo "</tr>";
			}
			}else{
				echo "<tr><td colspan='6' style='text-align:center;'>No hay registros en la BD</td></tr>";
					} ?>
	</tbody>
</table>