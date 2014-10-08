<div class='hero-unit'>
	<h2>Producto 					</h2>
	<strong>Nombre:    				</strong> <?php echo $actual->pro_nombre; ?> <br>
	<strong>Precio:    				</strong><?php echo $actual->pro_precio; ?> <br>
	<strong>Tiempo de Preparación:  </strong><?php echo $actual->pro_tiempo; ?> <br>
	<strong>Estado:                 </strong>
    <?php if($actual->pro_estado=="t"){ ?>
    Habilitado
    <?php }else{ ?>
    Deshabilitado
    <?php } ?>

	<?php 
		echo "<h2>Ingredientes 	</h2>";
			if(!empty($actual_2)){
				foreach ($actual_2 as $key => $value) {
					echo $value->ing_nombre." : ";
					echo $value->con_cantidad." ";
					echo $value->ing_medida."<br>";
				}
				}else{
					echo "<tr><td colspan='6' style='text-align:center;'>No posee Ingredientes</tr>";
				}

			?>
			<form method="post">
				<div class="form-actions">
					<button type="reset" class="btn" onclick="window.location='/furaibar/Producto'">Atras</button>
				</div>
			</form>
		</div>