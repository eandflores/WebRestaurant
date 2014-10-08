<?php
	App::uses('BaseDatos','Vendor');

	class Deadmin extends AppModel{ 

		public function get_ventas($fecha){
			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT * FROM venta Where ven_fecha='$fecha' AND ven_estado='REALIZADA'");

			$tmp = array();

			if(is_null($consulta)){
				return array();
			}
			foreach ($consulta as $key => $value) {
				$sql = "SELECT caj_nombre,suc_id FROM caja WHERE caj_id =".$value->caj_id;
				$r = $link->select_query($sql);
				$value->caj_nombre = $r[0]->caj_nombre;
				$value->suc_id = $r[0]->suc_id;
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$sql = "SELECT mes_numero FROM mesa WHERE mes_id =".$value->mes_id;
				$r = $link->select_query($sql);
				$value->mes_numero = $r[0]->mes_numero;
				$tmp[] = $value;
			}
			
			return $tmp;
		}

		public function get_ventasporsucursal($fecha,$sucursal){
			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT * FROM venta V,caja C WHERE V.ven_fecha='$fecha' AND V.ven_estado='REALIZADA' AND V.caj_id=C.caj_id AND C.suc_id='$sucursal'");

			$tmp = array();

			if(is_null($consulta)){
				return array();
			}
			foreach ($consulta as $key => $value) {
				$sql = "SELECT caj_nombre,suc_id FROM caja WHERE caj_id =".$value->caj_id;
				$r = $link->select_query($sql);
				$value->caj_nombre = $r[0]->caj_nombre;
				$value->suc_id = $r[0]->suc_id;
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$sql = "SELECT mes_numero FROM mesa WHERE mes_id =".$value->mes_id;
				$r = $link->select_query($sql);
				$value->mes_numero = $r[0]->mes_numero;
				$tmp[] = $value;
			}
			
			return $tmp;
		}
	
		public function sucursales(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT suc_id,suc_nombre FROM sucursal ORDER BY suc_nombre");
			
			return $consulta;
		}

		public function buscarProductos($Id){
			$link = new BaseDatos();
			$consulta = $link->select_query("SELECT * FROM pedido P,cuenta C,Producto Pro WHERE P.ven_id ='$Id' AND P.ped_id=C.ped_id 
					AND C.pro_id=Pro.pro_id");
			return $consulta;
		}

		public function buscarMenus($Id){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM pedido P,tiene T,menu M WHERE P.ven_id ='$Id' AND P.ped_id=T.ped_id 
					AND T.men_id=M.men_id");
			
			return $consulta;
		}

		public function buscarVenta($Id){
			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT * FROM venta Where ven_id='$Id'");

			$tmp = array();

			if(is_null($consulta)){
				return array();
			}
			foreach ($consulta as $key => $value) {
				$sql = "SELECT caj_nombre,suc_id FROM caja WHERE caj_id =".$value->caj_id;
				$r = $link->select_query($sql);
				$value->caj_nombre = $r[0]->caj_nombre;
				$value->suc_id = $r[0]->suc_id;
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$sql = "SELECT mes_numero FROM mesa WHERE mes_id =".$value->mes_id;
				$r = $link->select_query($sql);
				$value->mes_numero = $r[0]->mes_numero;
				$tmp[] = $value;
			}
			
			return $tmp;
		}
	}	
?>