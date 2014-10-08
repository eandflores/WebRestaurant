<?php
	App::uses("BaseDatos", "Vendor");

	class Sucursal extends AppModel{

		public function mostrarSuc(){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM sucursal ORDER BY suc_nombre");
			
			return $consulta;
		}

		public function registrarSuc($form){ 
			$nombre=$form['nombre'];
			$direccion=$form['direccion'];
			$telefono=$form['telefono'];

			$link = new BaseDatos();
			$consulta=$link->insert_query("INSERT INTO sucursal( suc_nombre, suc_direccion, suc_telefono)
    									VALUES ( '$nombre', '$direccion', '$telefono');");
			
			return $consulta;
		}

		public function verSucursal($id){
			$link = new BaseDatos();
			$consulta = $link->select_query("SELECT * from sucursal WHERE suc_id='$id'");
			return $consulta;
		}
		
		public function actualizar($id,$data){
			$link = new BaseDatos();

			$sql = "UPDATE sucursal SET suc_nombre ='{nombre}', suc_direccion='{direccion}', suc_telefono='{telefono}' WHERE suc_id='$id'";
			$sql = str_replace("{nombre}", $data["nombre"], $sql);
			$sql = str_replace("{direccion}", $data["direccion"], $sql);
			$sql = str_replace("{telefono}", $data["telefono"], $sql);
			$response = $link->insert_query($sql);
			return $response;
		}
	}
?>