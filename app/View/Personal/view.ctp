<div class='hero-unit'>
	<h2>Usuario <?php echo $actual->tra_rut; ?></h2>
	<strong>Nombres:    </strong> <?php echo $actual->tra_nombre; ?> <br>
	<strong>Apellidos:  </strong><?php echo $actual->tra_apellido; ?> <br>
	<strong>Correo:     </strong> <?php echo $actual->tra_correo; ?> <br>
	<strong>Teléfono:   </strong><?php echo $actual->tra_telefono; ?> <br>
	<strong>Dirección:  </strong> <?php echo $actual->tra_direccion; ?> <br>
	<?php if($actual->tra_estado==true){ ?>
	<strong>Estado:     </strong>Habilitado<br>
	<?php }else{ ?>
	<strong>Estado:     </strong>Deshabilitado<br>
	<?php } ?>
	<strong>Rol:        </strong><?php echo $actual->rol_nombre; ?> <br>
	<strong>Sucursal:   </strong><?php echo $actual->suc_nombre; ?>

	<form method="post">
    	<div class="form-actions">
      		<button type="reset" class="btn" onclick="window.location='/furaibar/Personal/index'">Atras</button>
    	</div>
	</form>
</div>

