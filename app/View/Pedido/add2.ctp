
<form method="post" class="form-horizontal well" action="/furaibar/Pedido/add2/">
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
				      			<input id="<?php echo 'producto'.$key ?>" name="cantidadproducto[]" type="number" min="0" value="0">
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
				      			<input id="<?php echo 'promocion'.$key ?>" name="cantidadpromocion[]" type="number" min="0" value="0">
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
		<h3>Mesa</h3>
		<select name='mesa' id="mesa">
									<?php 
										foreach ($actual as $key => $value) {
		printf("<option value='%d'>mesa %d</option>\n",$value->mes_id,$value->mes_numero);
										
										}
									?>
								</select>	

		<!--<input type="hidden" name="mediopago" value="<?php //echo $medio_pago ?>">
		<input type="hidden" name="sucursal" value="<?php //echo $_sucursal ?>">
		<input type="hidden" name="mesa" value="<?php //echo $_mesa ?>">
		<input type="hidden" name="cliente" value="<?php //echo $_cliente ?>">
		
        <div class="alert alert-warning">
          	<h4 class="alert-heading">Información!!</h4>
          	<p>Se recomienda calcular el Valor del Pedido antes de Ingresarlo al Sistema.</p>
        </div>-->
		<div class="form-actions">
	        <button class="btn btn-primary" type="submit">Agregar Pedido</button>
	        <button class="btn" type="reset" onclick="window.location='/furaibar/Pedido'">Cancelar</button>
        </div>
    </fieldset>
</form>
<div class="form-actions" style="border-radius:5px">
	<div class="alert alert-warning">
          	<h4 class="alert-heading">Información!!</h4>
          	<p>Se recomienda calcular el Valor del Pedido antes de Ingresarlo al Sistema.</p>
        </div>
	<h3>Calcular Total</h3>
    <button class="btn btn-warning" type="submit" id="calcular" style="float:left;margin-right:25px;">Calcular</button>
    <div>
        <div class="controls" style="float:left;">
           <input id="total" type="text" min="0" value="0" readonly style="color:black">
        </div>
    </div>
</div>
<script language="javascript">
	var e=document.getElementById('calcular');

	e.onclick=function(){
		var i=0;
		var suma1=0;
		var suma2=0;
		var elemento=0;

		while(i < <?php echo $ContadorProductos ?> ){
			elemento=parseInt(document.getElementById('producto'+i).value)*parseInt(document.getElementById('precioproducto'+i).value);
			suma1=suma1+elemento;
			i++;
		}

		i=0;

		while(i < <?php echo $ContadorPromociones ?> ){
			elemento=parseInt(document.getElementById('promocion'+i).value)*parseInt(document.getElementById('preciopromocion'+i).value);
			suma2=suma2+elemento;
			i++;
		}

   		document.getElementById('total').value=suma1+suma2;
	}
</script>
