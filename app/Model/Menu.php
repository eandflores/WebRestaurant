<?php
	App::uses('BaseDatos','Vendor');

	class Menu extends AppModel{ 
		public function insertar($form){ 
			$Nombre=$form['Nombre'];
			$Precio=$form['Precio'];
			$Estado=true;
			$pro_id=$form['ides'];
			$cantidad=$form['cant'];
			$Sucursal=$form['selectSucursal'];

			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT men_id FROM menu WHERE men_nombre='$Nombre'");

			if($consulta==null){
				$consulta2=$link->insert_query("INSERT INTO menu(men_nombre,men_total,men_cantidad,men_estado,suc_id) 
				VALUES('$Nombre','$Precio',0,'$Estado','$Sucursal')");

				$consulta3=$link->select_query("SELECT men_id FROM menu ORDER BY men_id DESC LIMIT 1");
				$idmen=$consulta3[0]->men_id;
				$suma=0;

				for($i=0; $i<sizeof($pro_id); $i++){
					$idpro=$pro_id[$i];
					$cant=$cantidad[$i];

					if($cant != 0 ){
						$suma=$suma+$cant;
						$consulta=$link->insert_query("INSERT INTO posee(men_id, pro_id, pos_cantidad)
	    												VALUES ($idmen, $idpro, $cant)");
					}
				}
				$consulta2=$link->insert_query("UPDATE menu SET men_cantidad='$suma' WHERE men_id='$idmen'");
			}else
				$consulta2=false;
			
			return $consulta2;
		}

		public function relacionar($Promo,$Producto){
			$link = new BaseDatos();
			
			$consulta=$link->select_query("SELECT * FROM posee WHERE men_id='$Promo' AND pro_id='$Producto'");

			if($consulta==null)
			$consulta2=$link->insert_query("INSERT INTO posee(men_id,pro_id,pos_cantidad) 
				VALUES('$Promo','$Producto',1)");
			else
			$consulta2=$link->insert_query("UPDATE posee SET pos_cantidad=pos_cantidad+1 WHERE men_id='$Promo' AND pro_id='$Producto'");
			
			return $consulta2;
		}

		public function mostrar(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM menu ORDER BY men_nombre");
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
			$consulta=$link->select_query("SELECT * FROM menu WHERE suc_id='$sucursal' ORDER BY men_nombre");
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

		public function productos(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM producto ORDER BY pro_nombre");
			
			return $consulta;
		}

		public function getPromoId($Nombre){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT men_id FROM menu WHERE men_nombre='$Nombre'");

			return $consulta[0]->men_id;
		}
		public function modificar($Id,$form){ 
			$link = new BaseDatos();
			$Nombre=$form['Nombre'];
			$Precio=$form['Precio'];

			$prod_id=$form['ides'];
			$cantidad=$form['cant'];

			for($i=0; $i<sizeof($prod_id); $i++){
				$idprod=$prod_id[$i];
				$cant=$cantidad[$i];
				
				if($cant!=0)
					$consulta=$link->insert_query("UPDATE posee SET pos_cantidad='$cant' WHERE pro_id='$idprod' AND men_id='$Id'");
				else
					$consulta=$link->insert_query("DELETE FROM posee WHERE pro_id='$idprod' AND men_id='$Id'");	
			}


			$prod_id=$form['idesotro'];
			$cantidad=$form['cantotro'];
			for($i=0; $i<sizeof($prod_id); $i++){
				$idprod=$prod_id[$i];
				$cant=$cantidad[$i];
				if($cant != 0 ){
					$consulta=$link->insert_query("INSERT INTO posee(men_id,pro_id,pos_cantidad) VALUES ($Id, $idprod, $cant);");
				}
			}
			
			$sql = $link->select_query("SELECT Sum(pos_cantidad) AS pro_cont FROM posee WHERE men_id ='$Id'");
			
			if($sql[0]->pro_cont!=null)
			$CantProd=$sql[0]->pro_cont;
			else
			$CantProd=0;

			$consulta=$link->insert_query("UPDATE menu SET men_nombre='$Nombre',men_total='$Precio',men_cantidad='$CantProd'
										WHERE men_id='$Id'");
			
			return $consulta;
		}

		public function buscarProductos($id){
			$link = new BaseDatos();
			$ingre = $link->select_query("SELECT * FROM producto Pro, posee P WHERE P.men_id='$id' AND P.pro_id = Pro.pro_id");
			return $ingre;
		}

		public function buscar($Id){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM menu WHERE men_id='$Id'");

			if(is_null($consulta)){
				return array();
			}
			foreach ($consulta as $key => $value) {
				$sql = "SELECT Sum(pos_cantidad) AS pro_cont FROM posee WHERE men_id =".$value->men_id;
				$r = $link->select_query($sql);
				$value->pro_cont = $r[0]->pro_cont;
				$tmp[] = $value;
			}
			
			return $tmp;
		}

		public function eliminar($Id){
			$link = new BaseDatos();

			$consulta=$link->insert_query("UPDATE menu SET men_estado=false WHERE men_id='$Id'");

			return $consulta;
		}
		public function enable($Id){
			$link = new BaseDatos();

			$consulta=$link->insert_query("UPDATE menu SET men_estado=true WHERE men_id='$Id'");

			return $consulta;
		}
	}
?>