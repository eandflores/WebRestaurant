<h3>Gestión Productos</h3>
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
<a href="producto/add" class="Agregar">Agregar producto</a>
<table class='table table-bordered table-striped table-hover'>
	<thead>
		<tr>
			<th id="nombre">Nombre</th>
			<th id="precio">Precio</th>
			<th>Tiempo de Preparación</th>
			<th>Estado</th>
			<th>Sucursal</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tboby>
		<?php 
		if(!empty($prod)){
			foreach ($prod as $key => $value) {
				echo "<tr>";
				echo "<td>".$value->pro_nombre."</td>";
				echo "<td>".$value->pro_precio."</td>";
				echo "<td>".$value->pro_tiempo." minutos</td>";
				if($value->pro_estado=="t"){ ?>
              		<td>Habilitado</td>
              	<?php 
              	}else{ ?>
              		<td>Deshabilitado</td>
              	<?php 
              	} 
				echo "<td>".$value->suc_nombre."</td>";
				echo "<td>";
				echo "<a class='accion1' href='/furaibar/Producto/view/".$value->pro_id."'><i class='icon-white icon-search'></i></a>";
				echo "<a class='accion'href='/furaibar/Producto/edit/".$value->pro_id."'><i class='icon-white icon-pencil'></i></a>";
				if($value->pro_estado!='t'){ ?>
                  <a href="/furaibar/Producto/enable/<?php echo $value->pro_id ?>" class="accion"><i class='icon-white icon-ok'></i></a>
                <?php 
            	}else{ ?> 
                  <a href="/furaibar/Producto/delete/<?php echo $value->pro_id ?>" class="accion"><i class='icon-white icon-remove'></i></a>
                <?php 
            	} 
				echo "</tr>";
			}
		}else{
				echo "<tr><td colspan='6' style='text-align:center;'>No hay Productos Disponibles</td></tr>";
					} ?>
	</tbody>
</table>
