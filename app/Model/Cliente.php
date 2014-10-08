<?php
	App::uses("BaseDatos", "Vendor");

	class Cliente extends AppModel{

		public function readAll(){
			$Fecha=date('Y-m-d');

			$link = new BaseDatos();
			$sql = "SELECT * FROM cliente order by cli_rut";
			$response = $link->select_query($sql);
			$tmp = array();
			if(is_null($response)){
				return array();
			}
			return $response;
		}

		

		public function get($id){
			$link = new BaseDatos();
			$res = $link->select_query("SELECT * from cliente WHERE cli_rut='$id';");
			return $res;
		}


		public function actualizar($rut,$data){
			$link = new BaseDatos();
			$sql = "UPDATE cliente SET cli_rut ='{rut}', cli_nombre='{nombre}', cli_apellido='{apellido}', cli_correo='{correo}', cli_telefono='{telefono}' WHERE cli_rut='$rut'";
			$sql = str_replace("{rut}", $data["rut"], $sql);
			$sql = str_replace("{nombre}", $data["nombre"], $sql);
			$sql = str_replace("{apellido}", $data["apellido"], $sql);
			$sql = str_replace("{correo}", $data["correo"], $sql);
			$sql = str_replace("{telefono}", $data["telefono"], $sql);
			$response = $link->insert_query($sql);
			return $response;
		}

		public function guardar_cliente($datos){
			$link = new BaseDatos();
			$sql = "INSERT INTO cliente(cli_rut, cli_nombre, cli_apellido, cli_correo, cli_telefono, cli_direccion, cli_password)
					VALUES('{rut}','{nombre}','{apellido}','{correo}','{telefono}','{direccion}','{password}')";
			$sql = str_replace("{rut}", $datos["rut"], $sql);
			$sql = str_replace("{nombre}", $datos["nombre"], $sql);
			$sql =	str_replace("{apellido}", $datos["apellidos"], $sql);
			$sql =	str_replace("{correo}", $datos["correo"], $sql);
			$sql =	str_replace("{telefono}", $datos["telefono"], $sql);
			$sql =	str_replace("{direccion}", $datos["direccion"], $sql);
			$sql = str_replace("{password}", md5($datos["clave"]), $sql);    //ojo!!!
			return $link->insert_query($sql);
		}

		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("DELETE FROM cliente WHERE cli_rut='$Id'");
			return $consulta;
		}
	}


?>