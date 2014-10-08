<?php
	App::uses("BaseDatos", "Vendor");

	class Mesa extends AppModel{

		public function AgregarMesa($datos){
			$link = new BaseDatos();
			$numero = $datos["mes_numero"];
			$sucursal = $datos["suc_id"];

			$consulta = "SELECT mes_id FROM mesa WHERE mes_numero = '$numero' and suc_id = '$sucursal'";
			$response = $link->select_query($consulta);

			if(is_null($response)){
				$sql = "INSERT INTO mesa(mes_estado, mes_numero, suc_id)
					VALUES(TRUE, '$numero', '$sucursal')";

				return $link->insert_query($sql);
			}
			else{
				return null;
			}
			
		}

		public function MostrarMesas(){

			$link = new BaseDatos();
			$sql = "SELECT * FROM mesa WHERE mes_numero != -1 ORDER BY mes_numero";
			$response = $link->select_query($sql);
			$tmp = array();
			
			if(is_null($response)){
				return array();
			}
			foreach ($response as $key => $value) {
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$tmp[] = $value;
			}
			return $tmp;
		}


		public function verMesas($id){
			$link = new BaseDatos();
			$consulta = $link->select_query("SELECT * FROM mesa WHERE mes_id='$id'");
			return $consulta;
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
			$consulta=$link->select_query("SELECT * FROM mesa WHERE suc_id='$sucursal' ORDER BY mes_id");
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
			$consulta=$link->insert_query("DELETE FROM mesa WHERE mes_id='$Id' AND mes_estado=TRUE AND mes_numero!='-1'");

			return $consulta;
		}

	}

?>