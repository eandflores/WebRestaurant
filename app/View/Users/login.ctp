<?php 
	if(isset($estado)){
?>
<div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Error iniciando sesión</strong>
  <br>
  Al parecer tu usuario o contraseña son incorrectas
</div>
<?php 
	}
?>
<form class="form-horizontal well" method='post'>
			<div class="control-group">
				<label class="control-label" for="rut">Rut:</label>
			    <div class="controls">
			      <input type="text" id="rut" placeholder="Rut" name='usuario' required	>
			    </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="pass">Clave:</label>
			    <div class="controls">
			      <input type="password" id="pass" name='password' placeholder="Clave" required>
			    </div>
			 </div>
			 <div class='form-actions'>
			 	<button type='submit' class='btn btn-success'><i class='icon-user'></i> Iniciar Sesión</button>
			 	<button type='reset' class='btn btn-warning'><i class='icon-remove'></i> Cancelar</button>
			 </div>
		</form>

<script type="text/javascript">

	(function(){
		$("#rut").rut();
	})()
</script>