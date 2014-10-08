

<div class='span12'>
	<?php 
		//if(!$caja){
		//	echo "<h1>Debe Abrir caja primero, <a href='/furaibar/Ventas/abrir/'>haz click aqui para abrir</a></h1>";
		//}else{

	?>
	<h3>Total Venta: <input type='hidden' id='total' name="total" value='0'>$<span id='total_venta'>0</span></h3>
		 <div class='row-fluid well'>
		 	<form action="/furaibar/Ventas/ticket2" method='post'>
		 		
		 		
		 		<div id='fijo'>
			 		<div class='control-group'>
					

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
