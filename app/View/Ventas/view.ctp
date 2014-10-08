		<div class='hero-unit'>
			<h2>VENTAS 	</h2>
			<strong>FECHA DE VENTA:    </strong> <?php echo $actual->ven_fecha; ?> <br>
			<strong>TOTAL DE VENTAS:  </strong><?php echo $actual->ven_total; ?> <br>
			<strong>FORMA DE PAGO:  </strong><?php echo $actual->ven_forma_pago; ?> <br>
			<br>

			<form method="post">
				<div class="form-actions">
					<button type="reset" class="btn" onclick="window.location='/furaibar/Sucursal'">Atras</button>
				</div>
			</form>
		</div>
