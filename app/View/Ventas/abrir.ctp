	<div class='alert alert-error' id='error' style="display:none">
		<h3>Lo sentimos</h3>
		Debes seleccionar una Caja
	</div>
	<form class='form-horizontal well' method='post'>
		<legend>Abriendo Caja</legend>
		<div class='control-group'>
		 	<label for='caja' class='control-label'>Selecione Caja:</label>
		 	<div class='controls'>
		 		<select id='caja' name='caj_id'>
		 			<option value='-1'>Seleccione Caja</option>
		 			<?php 
		 				if(!empty($cajas)){
		 					foreach ($cajas as $key => $value) {
		 						echo "<option value='".$value->caj_id."'>".$value->caj_id."</option>";
		 					}
		 				}
		 			?>
		 		</select>
		 	</div>
		</div>
		<div class='control-group' style="display:none">
			<label class='control-label' for='sinicial'>Saldo Inicial:</label>
			<div class='controls'>
				<input type='number' name='saldo_inicial' id='sinicial' required min='0' value='0'>
			</div>
		</div>
		<div class='form-actions'>
			<button type='submit' class='btn btn-success'><i class='icon-off'></i> Abrir</button>
			<button type='reset' class='btn btn-warning'><i class='icon-share-alt'></i> Cancelar</button>
		</div>
	</form>

<script type="text/javascript">
	$(":reset").click(function(){
		window.location = "/furaibar/Ventas";
	})

	$("form").submit(function(e){
		e.preventDefault();
		var c = $("#caja").val();
		if(c == -1){
			$("#error").fadeIn();
		}else{
			this.submit();
		}
	})

</script>
