<div class='hero-unit'>
	<strong>Nombres:    </strong> <?php echo $actual->cli_nombre; ?> <br>
	<strong>Apellidos:  </strong><?php echo $actual->cli_apellido; ?> <br>
	<strong>Telefono:        </strong><?php echo $actual->cli_telefono; ?> <br>
	<strong>Fecha:   </strong><?php echo $actual->res_fecha; ?><br>
	<strong>N° mesa:   </strong><?php echo $actual->mes_numero; ?><br>
	<strong>Sucursal:   </strong><?php echo $actual->suc_nombre; ?><br>

	<form method="post">
    	<div class="form-actions">
      		<button type="reset" class="btn" onclick="window.location='/furaibar/Reserva/index'">Atras</button>
    	</div>
	</form>
</div>

