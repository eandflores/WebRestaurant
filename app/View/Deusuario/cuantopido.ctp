<form class="form-horizontal well" action="/furaibar/Deusuario/cuantopido2"  method="post">
    <fieldset>
    	<h3>¿Cuántos quieren comer?</h3>
        <div class="control-group">
            <label for="selectHombres" class="control-label"><h4>Hombres</h4></label>
            <div class="controls">
              	<select id="selectHombres" name="hombres">
	                <option value="0">0</option>
	                <option value="1">1</option>
	                <option value="2">2</option>
	                <option value="3">3</option>
	                <option value="4">4</option>
	                <option value="5">5</option>
	                <option value="6">6</option>
	                <option value="7">7</option>
	                <option value=="8">8</option>
	                <option value="9">9</option>
	                <option value="10">10</option>
              	</select>
            </div>
        </div>
        <div class="control-group">
            <label for="selectMujeres" class="control-label"><h4>Mujeres</h4></label>
            <div class="controls">
              	<select id="selectMujeres" name="mujeres">
	                <option value="0">0</option>
	                <option value="1">1</option>
	                <option value="2">2</option>
	                <option value="3">3</option>
	                <option value="4">4</option>
	                <option value="5">5</option>
	                <option value="6">6</option>
	                <option value="7">7</option>
	                <option value="8">8</option>
	                <option value="9">9</option>
	                <option value="10">10</option>
              	</select>
            </div>
        </div>
        <div class="control-group">
            <label for="selectNiños" class="control-label"><h4>Niños</h4></label>
            <div class="controls">
              	<select id="selectNiños" name="ninios">
	                <option value="0">0</option>
	                <option value="1">1</option>
	                <option value="2">2</option>
	                <option value="3">3</option>
	                <option value="4">4</option>
	                <option value="5">5</option>
	                <option value="6">6</option>
	                <option value="7">7</option>
	                <option value="8">8</option>
	                <option value="9">9</option>
	                <option value="10">10</option>
              	</select>
            </div>
        </div>

    	<h3>¿Cuánta hambre tienen?</h3>
        <div class="control-group">
	        <label for="checkAntojo" class="radio">     
	  			<input id="checkAntojo" name="hambre" type="radio" value="0" checked>
	  			<h4>Antojo</h4>
          	</label>
        </div>
        <div class="control-group">
	        <label for="checkHambre" class="radio">
  				<input id="checkHambre" name="hambre" type="radio" value="1">
  				<h4>Hambre</h4>
          	</label>
        </div>
        <div class="control-group">
	        <label for="checkVoraz" class="radio">
	      		<input id="checkVoraz" name="hambre" type="radio" value="2">
	      		<h4>Voraz</h4>
          	</label>
        </div>
        <div class="control-group">
	        <label for="checkNomas" class="radio">  
	      		<input id="checkNomas" name="hambre" type="radio" value="3">
	      		<h4>No doy más</h4>	
          	</label>   
        </div>
        	
		<?php if(isset($Estado)){
			    if($Estado=='true')
			    	echo "<di<div class='span4'>
			      			<div class='alert alert-success'>
			        			<a class='close'>&times;</a>
			        			<strong>Success</strong> 
			        			Compra realizada exitosamenete.
			      			</div>
			    		  </div>";
			    else
			    	echo "<div class='span4'>
			      			<div class='alert alert-error'>
			        			<a class='close'>&times;</a>
			        			<strong>Error</strong> No se pudo realizar la compra.
			      			</div>
			    		  </div> ";
			    } ?>
		<div class="form-actions">
		    <button class="btn btn-primary" type="submit">Enviar</button>
		    <button class="btn" type="reset" onclick="window.location='/furaibar/Deusuario'">Atras</button>
		</div>
    </fieldset>
 </form>
