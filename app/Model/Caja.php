<?php
	App::uses("BaseDatos", "Vendor");

	class Caja extends AppModel{

		public function AgregarCaja($datos){
			$link = new BaseDatos();
			$sql = "INSERT INTO caja(caj_nombre, suc_id)
					VALUES('{caj_nombre}','{suc_id}')";
			$sql = str_replace("{caj_nombre}", $datos["caj_nombre"], $sql);
			$sql = str_replace("{suc_id}", $datos["suc_id"], $sql);
			return $link->insert_query($sql);
		}

		public function MostrarCajas(){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM caja ORDER BY caj_id");
			$tmp = array();

			if(is_null($consulta)){
				return array();
			}
			foreach ($consulta as $key => $value) {
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$tmp[] = $value;
			}
			
			return $tmp;
		}

		public function getSucursales(){
			$link = new BaseDatos();
			return $link->select_query("SELECT * FROM sucursal");
		}

		public function sucursales(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT suc_id,suc_nombre FROM sucursal ORDER BY suc_nombre");
			
			return $consulta;
		}

		public function mostrarporsucursal($sucursal){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM caja WHERE suc_id='$sucursal' ORDER BY caj_id");
			$tmp = array();

			if(is_null($consulta)){
				return array();
			}
			foreach ($consulta as $key => $value) {
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$tmp[] = $value;
			}
			
			return $tmp;
		}

		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("DELETE FROM caja WHERE caj_id='$Id'");

			return $consulta;
		}
		
	}

?>