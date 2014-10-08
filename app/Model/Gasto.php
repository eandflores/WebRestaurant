<?php
	App::uses('BaseDatos','Vendor');

	class Gasto extends AppModel{ 
		public function insertar($form){ 
			$Rut=$form['selectRut'];
			$Caja=$form['selectCaja'];
			$Monto=$form['Monto'];
			$Motivo=$form['Motivo'];
			$Fecha=$form['Fecha'];

			$link = new BaseDatos();
			$consulta=$link->insert_query("INSERT INTO gasto(tra_rut,caj_id,gas_monto,gas_motivo,gas_fecha) 
				VALUES('$Rut','$Caja','$Monto','$Motivo','$Fecha')");
			
			return $consulta;
		}

		public function mostrar(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM Gasto G, Caja C WHERE G.caj_id=C.caj_id ORDER BY G.caj_id");
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

		public function mostrarporsucursal($sucursal){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM Gasto G, Caja C WHERE G.caj_id=C.caj_id AND C.suc_id='$sucursal' ORDER BY G.caj_id");
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

		public function sucursales(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT suc_id,suc_nombre FROM sucursal ORDER BY suc_nombre");
			
			return $consulta;
		}

		public function ruts(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT tra_rut FROM trabajador ORDER BY tra_rut");
			
			return $consulta;
		}

		public function cajas($Sucursal){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT caj_id FROM caja WHERE suc_id='$Sucursal' ORDER BY caj_id");
			
			return $consulta;
		}

		public function buscar($Id){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM ingrediente WHERE ing_id='$Id'");

			return $consulta;
		}

		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("DELETE FROM gasto WHERE gas_id='$Id'");

			return $consulta;
		}
	}
?>