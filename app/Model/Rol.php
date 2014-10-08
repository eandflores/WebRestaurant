<?php
	App::uses("BaseDatos", "Vendor");

	class Rol extends AppModel{

		public function mostrarRol(){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM rol ORDER BY rol_nombre");
			
			return $consulta;
		}

		public function insertar($form){ 
			$nombre=$form['nombre'];
			$sueldo=$form['sueldo'];
			$sueldo2=$form['sueldo2'];

			$link = new BaseDatos();
			$consulta=$link->insert_query("INSERT INTO rol( rol_nombre, rol_sueldo_base, rol_sueldo_hora)
    										VALUES ( '$nombre', $sueldo, $sueldo2)");
			
			return $consulta;
		}

		public function verRol($id){
			$link = new BaseDatos();
			$rol = $link->select_query("SELECT * from rol WHERE rol_id='$id'");
			return $rol;
		}

		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("DELETE FROM rol WHERE rol_id='$Id'");

		
			return $consulta;
		}

		public function actualizar($id,$data){
			$link = new BaseDatos();
			$sql = "UPDATE rol SET rol_nombre ='{nombre}', rol_sueldo_base='{sueldo}', rol_sueldo_hora='{sueldo2}' WHERE rol_id='$id'";
			$sql = str_replace("{nombre}", $data["nombre"], $sql);
			$sql = str_replace("{sueldo}", $data["sueldo"], $sql);
			$sql = str_replace("{sueldo2}", $data["sueldo2"], $sql);
			$response = $link->insert_query($sql);

			return $response;
		}
	}
?>