<?php 
if(isset($Estado)){
	if($Estado==false){
?>
		<div class="alert alert-error">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Error al Registrar</strong><br>
  			Las contraseñas no Coinciden
		</div>
<?php 
	}
	else{
?>
		<div class="alert alert-success">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Registro Exitoso</strong><br>
  			El Registro se ha Completado Exitosamente
		</div>
<?php
	}
}
?>	
<h3>Registro de Nuevo Usuario</h3>
<form method="post" class="form-horizontal well">
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="rut">Rut</label>
	            <div class="controls">
	              	<input type="text" id="rut" name="rut" placeholder="Rut" maxlength="12" required>
	            </div>
	        </div>
	        <div class="control-group">
	            <label class="control-label" for="inputNombre">Nombre</label>
	            <div class="controls">
	              	<input type="text" id="inputNombre" name="nombre" placeholder="Nombre" maxlength="30" required>
	            </div>
	        </div>
	        <div class="control-group">
	            <label class="control-label" for="inputApellido" >Apellido</label>
	            <div class="controls">
	              	<input type="text" id="inputApellido" name="apellido" placeholder="Apellido" maxlength="20" required>
	            </div>
	        </div>
	        <div class="control-group">
	            <label class="control-label" for="inputCorreo" >Correo</label>
	            <div class="controls">
	              	<input type="email" id="inputCorreo" name="correo" placeholder="Correo" maxlength="20" required>
	            </div>
	        </div>
			<div class="control-group">
	            <label class="control-label" for="inputTelefono">Télefono</label>
	            <div class="controls">
	              	<input type="number" id="inputTelefono" name="telefono" placeholder="Teléfono" maxlength="99999999" required>
	            </div>
			</div>
	        <div class="control-group">
	            <label class="control-label" for="inputDireccion">Dirección</label>
	            <div class="controls">
	              	<input type="text" id="inputDireccion" name="direccion" placeholder="Dirección" maxlength="30" required>
	            </div>
			</div>
			<div class="control-group">
	            <label class="control-label" for="inputContraseña">Contraseña</label>
	            <div class="controls">
	              	<input type="password" id="inputContraseña" name="contrasenia" placeholder="Contraseña" maxlength="10" required>
	            </div>
	        </div>
	        <div class="control-group">
	            <label class="control-label" for="inputContraseña2">Repetir Contraseña</label>
	            <div class="controls">
	              	<input type="password" id="inputContraseña2" name="repcontrasenia" placeholder="Repetir contraseña" maxlength="10" required>
	            </div>
	        </div>
			<div class="form-actions">
			    <button class="btn btn-primary" type="submit"> Registrarme</button>
			    <button type="reset" class="btn" onclick="window.location='/furaibar/'">Cancelar</button>
		    </div>
		</fieldset>
	</form>
		
</fieldset>

<script type="text/javascript">
	(function(){
		$("#rut").rut();
	})()
</script>

