<form method="post" class="form-horizontal well izquerdo" action="/furaibar/Deusuario/pedidos2/">
	<fieldset>
		<h3>Productos</h3>
		<table class="table table-bordered table-striped table-hover">
			<thead>
			    <tr>
			     	<th>Nombre</th>
				    <th>Cantidad</th>
				    <th>Precio</th>
			    </tr>
			</thead>
			<tbody>
			    <?php 
			    $ContadorProductos=0;
				if($Datos_productos!=null){
				    foreach ($Datos_productos as $key => $value) { ?>
			    		<tr>
			      			<td ><?php echo $value->pro_nombre ?></td>
			      			<td>
				      			<input id="<?php echo 'producto'.$key ?>" class="producto" name="cantidadproducto[]" type="number" min="0" value="0">
				      		</td>
				      		<input type="hidden" name="idproducto[]" type="number" value="<?php echo $value->pro_id ?>">
				      		<input id="<?php echo 'precioproducto'.$key ?>" type="hidden" type="number" value="<?php echo $value->pro_precio ?>">
				      		<span data-precio="<?php echo $value->pro_precio ?>">
				        	<td ><?php echo $value->pro_precio ?></td>
			      		</tr>
			      		<?php $ContadorProductos++;
					}
				}else{ ?>
					<tr>
	            		<td colspan='6'>No hay produtos en la Base de Datos</td>
	          		</tr>
      	  <?php } ?>
			</tbody>
		</table>
		<h3>Menus</h3>
		<table class="table table-bordered table-striped table-hover">
			<thead>
			    <tr>
			    	<th>Nombre</th>
				    <th>Cantidad</th>
				    <th>Precio</th>
			    </tr>
			</thead>
			<tbody>
				<?php 
			    $ContadorPromociones=0;
				if($Datos_promocion!=null){
				    foreach ($Datos_promocion as $key => $value){ ?>
				    	<tr>
			      			<td ><?php echo $value->men_nombre ?></td>
			      			<td>
				      			<input id="<?php echo 'promocion'.$key ?>" class="producto" name="cantidadpromocion[]" type="number" min="0" value="0">
				      		</td>
				      		<input type="hidden" name="idpromocion[]" type="number" value="<?php echo $value->men_id ?>">
				      		<input id="<?php echo 'preciopromocion'.$key ?>" type="hidden" type="number" value="<?php echo $value->men_total ?>">
				        	<td ><?php echo $value->men_total ?></td>
			      		</tr>
			    		<?php $ContadorPromociones++;
					}
				}else{ ?>
					<tr>
	            		<td colspan='6'>No hay Promociones en la Base de Datos</td>
	          		</tr>
      	  <?php } ?>
			</tbody>
		</table>	
		<input type="hidden" name="mediopago" value="<?php echo $medio_pago ?>">
		<input type="hidden" name="sucursal" value="<?php echo $_sucursal ?>">
		<h3 style="float:left; margin-top:15px;">Total</h3>
	    <div>
	        <div class="controls" style="float:left; margin-left:30px; margin-top:20px;">
	           <input id="total" type="text" min="0" value="0" readonly style="color:black">
	        </div>
	    </div>
		<div class="form-actions">
	        <input class="btn btn-primary" type="submit" value="Solicitar Pedido" style="margin-left:30px; width:150px;">
	        <input class="btn" type="reset" onclick="window.location='/furaibar/Deusuario'" value="Cancelar" style="margin-left:15px; width:150px;">
        </div>
    </fieldset>
</form>

<script>
	$(document).ready(function(){
		console.log("Entro 1");
		$('.producto').change(function(){
			console.log("Entro 2");
			var i=0;
			var suma1=0;
			var suma2=0;
			var elemento=0;

			while(i < <?php echo $ContadorProductos ?> ){
				elemento=parseInt($('#producto'+i).val())*parseInt($('#precioproducto'+i).val());
				suma1=suma1+elemento;
				i++;
			}

			i=0;

			while(i < <?php echo $ContadorPromociones ?> ){
				elemento=parseInt($('#promocion'+i).val())*parseInt($('#preciopromocion'+i).val());
				suma2=suma2+elemento;
				i++;
			}

	   		$('#total').val(suma1+suma2);
		});
	});
</script>
