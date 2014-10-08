<h3>Listado Roles</h3>
<a href="rol/add" class="Agregar">Agregar Rol</a>
<table class='table table-bordered table-striped table-hover'>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Sueldo Base</th>
			<th>Sueldo por Hora</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tboby>
		<?php 
			if(!empty($rol)){
				foreach ($rol as $key => $value) {
					echo "<tr>";
					echo "<td>".$value->rol_nombre."</td>";
					echo "<td>".$value->rol_sueldo_base."</td>";
					echo "<td>".$value->rol_sueldo_hora."</td>";
					echo "<td>";
					echo "<a class='accion accion1' href='rol/edit/".$value->rol_id."'><i class='icon-white icon-pencil'></i></a>";
					echo "<a class='accion' href='rol/delete/".$value->rol_id."'><i class='icon-white icon-trash'></i></a>";
					echo "</tr>";
				}
			}else{
					echo "<tr><td colspan='6' style='text-align:center;'>No hay registros en la BD</td></tr>";
			} ?>
	</tbody>
</table>
