<?php

	App::uses('BaseAuthenticate', 'Controller/Component/Auth');
	App::uses('BaseDatos','Vendor');

	class FuraiAuth  {
	    public function authenticate(CakeRequest $request, CakeResponse $response) {
	        $usuario = $request->data["usuario"];
	        $password = md5($request->data["password"]);
	        $db = new BaseDatos();
	        $response = $db->select_query("SELECT trabajador.*,rol.rol_nombre FROM trabajador,rol WHERE trabajador.tra_rut='$usuario' AND trabajador.tra_password='$password' AND trabajador.rol_id=rol.rol_id");
	        if(!is_null($response)){
	        	$_SESSION["usuario"] = $response[0];
	        	return array("administrator");
	        }else{
	        	$response = $db->select_query("SELECT cliente.* FROM cliente WHERE cliente.cli_rut='$usuario' AND cliente.cli_password='$password'");
	        	if(!is_null($response)){
	        		$response[0]->rol_nombre="CLIENTE";
	        		$_SESSION["usuario"] = $response[0];
	        		return array("administrator");
	        	}else
	        		return false;
 	        }
	    }
	}

?>