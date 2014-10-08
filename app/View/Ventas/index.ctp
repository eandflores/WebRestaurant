<?php 
	if(!$caja){
		echo "<h1>Debe Abrir caja primero, <a href='/furaibar/Ventas/abrir'>haz click aqui para abrir</a></h1>";
	}else{
		echo "<h1>La caja esta abierta, <a href='/furaibar/Ventas/cerrar'>haz click aqui para cerrar</a></h1>";
	}

?>