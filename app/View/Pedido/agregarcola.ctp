

<div class='span12'>
	<?php 
		//if(!$caja){
		//	echo "<h1>Debe Abrir caja primero, <a href='/furaibar/Ventas/abrir/'>haz click aqui para abrir</a></h1>";
		//}else{

	?>
	<h3>Total Venta: <input type='hidden' id='total' name="total" value='0'>$<span id='total_venta'>0</span></h3>
		 <div class='row-fluid well'>
		 	<form action="/furaibar/Pedido/agregarcola" method='post'>
		 		<input type='hidden' name='descripcion' id='descripcion_text' value="compra normal">
		 		<div class='span6'>
		 			<?php
		 				if(empty($productos)){
		 			 		echo "<h3>Sin Productos Para la venta</h3>";
		 			 	}else{
			 			 	foreach ($productos as $key => $value) {
			 			 		echo "<div class='controls controls-row'>";
			 			 		echo "<label class='checkbox span4'>";
			 			 		echo "<input type='checkbox' class='seleccion' id='prod_$key' data-key='prod_cant_$key' data-precio='$value->pro_precio' name='productos[$key][id]' value='$value->pro_id'>";
			 			 		echo $value->pro_nombre;
			 			 		echo "</label>";
			 			 		echo "<input type='number' class='con_pro' id='prod_cant_$key' data-id='$value->pro_id' data-key='prod_$key' name='productos[$key][cantidad]' placeholder='Cantidad' readonly>";
			 			 		echo "</div>";
			 			 		}
			 			 	}
		 			 	?>	
		 		</div>
		 		<div class='span6'>
		 			 	<?php 
		 			 		if(empty($promos)){
		 			 			echo "<h3>Sin Promociones para la venta</h3>";
		 			 		}else{
			 			 		foreach ($promos as $key => $value) {
			 			 			echo "<div class='controls controls-row'>";
				 			 		echo "<label class='checkbox span4'>";
				 			 		echo "<input type='checkbox' class='seleccion' id='promo_$key' data-key='promo_cant_$key' name='promociones[$key][id]' data-precio='$value->men_total' value='$value->men_id'/>";
				 			 		echo $value->men_nombre;
				 			 		echo "</label>";
				 			 		echo "<input type='number' class='con_pro promo' id='promo_cant_$key' data-key='promo_$key' data-id='$value->men_id' name='promociones[$key][cantidad]' placeholder='Cantidad' readonly>";
				 			 		echo "</div>";
			 			 		}
			 			 	}
		 			 	?>
		 		</div>
		 		<div id='fijo'>
			 		<div class='control-group'>
					<!--<input type="hidden" name="su" value="1" > <!--sucursal 1 =concepcion-->

					<label class='control-label' for="selectSucursal">Numero de Mesa</label>
							<div class='controls'>
								<select name='mesa' id="mesa">
									<?php 
										foreach ($actual as $key => $value) {
		printf("<option value='%d'>mesa %d</option>\n",$value->mes_id,$value->mes_numero);
										
										}
									?>
								</select>
							</div>
					</div>
			 		<div class='form-actions'>
			 			<button type='submit' class='btn btn-success'><i class='icon-share-alt'></i> OK</button>
			 		</div>
			 	</div>
		 	</form>
		 </div>

	<?php 
	   //}
	?>
</div>




<script type="text/javascript">

	$.getJSON("/furai/ventas/clientes",function(json){
		$("#cli_rut").typeahead({
			source: json
		})
		$("#cliente_rut").typeahead({
			source: json
		})
	})

	$("#fijo").affix();

	$(".con_pro").focusout(function(){
		var id = $(this).data("id");
		var cantidad = parseInt($(this).val());
		var flag = true;
		var $yo = $(this);
		var tipo = 1;
		var key = $(this).data("key");
		if($(this).hasClass("promo"))
			tipo = 2;
		if(isNaN(cantidad) || cantidad == "" )
			return false;
		$.getJSON("/furai/pedido/consulta/"+id+"/"+cantidad+"/"+tipo, function(json){
			if(!json.disponible){
				alert("No tenemos stock para el producto selecionado");
				flag = false;
			}
		})
		.error(function(){
			alert("Error grave! comuniquese con el administrador");
			flag = false;
		})
		.complete(function(){
			if(!flag){
				$("#"+key).attr("checked",false);
				$yo.val("0");
			}else{
				var precio = parseInt($("#"+key).data("precio"))
				actualizaTotal(cantidad, precio)
			}
		})
	})

	$(".seleccion").click(function(){
		var id = $(this).data("key");
		if(this.checked){
			$("#"+id).attr("readonly",false);
		}else{
			$("#"+id).attr("readonly",true);
		}	
	})

	function actualizaTotal(cantidad, precio){
		var actual = parseInt($("#total").val());
		alert(actual+"/"+cantidad+"/"+precio);
		actual += (cantidad * precio);
		alert(actual);
		$("#total").val(actual);
		$("#total_venta").html(actual);
	}

	$("input[name='ld']").click(function(){
		var val = $(this).val();
		if(val == 1){
			if($("#cliente_rut").val() == "")
				$("#con_registro").hide();
			else
				$("#con_registro").show();
			$("#domicilio").modal();
		}else{
			$("#descripcion_text").val("EN LOCAL");
		}
	})

	$("input[name='nor']").click(function(){
		var val = $(this).val();
		if(val == 0){
			$("#nueva_dir").fadeIn();
		}else{
			$("#nueva_dir").fadeOut();
		}
	})

	$("#guardar_direccion").click(function(){
		var flag = true;
		$("input[name='nor']").each(function(){
			var val = $(this).val();
			if(flag){
				if(val == 0){
					$("#descripcion_text").val("A DOMICILO :"+$("#new_dir").val());
					flag = false;
				}else{
					$("#descripcion_text").val("DOMICILO CLIENTE : ");
				}
			}
		})
	})

</script>