<?php
	App::uses("BaseDatos", "Vendor");

	class Producto extends AppModel{

		public function mostrarProd(){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM producto ORDER BY pro_nombre");
			
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
			$consulta=$link->select_query("SELECT * FROM producto WHERE suc_id='$sucursal' ORDER BY pro_nombre");
			
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

		public function mostrarIng(){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM ingrediente ORDER BY ing_nombre");
			
			return $consulta;
		}

		public function verProducto($id){
			$link = new BaseDatos();
			$prod = $link->select_query("SELECT * from producto WHERE pro_id='$id'");
			return $prod;
		}

		public function verIngrediente($id){
			$link = new BaseDatos();
			$ingre = $link->select_query("SELECT * from ingrediente I, consume C WHERE C.pro_id='$id' AND C.ing_id = I.ing_id");
			return $ingre;
		}		

		public function eliminar($Id){
			$link = new BaseDatos();

			$consulta=$link->insert_query("UPDATE producto SET pro_estado=false WHERE pro_id='$Id'");

			return $consulta;
		}
		public function enable($Id){
			$link = new BaseDatos();

			$consulta=$link->insert_query("UPDATE producto SET pro_estado=true WHERE pro_id='$Id'");

			return $consulta;
		}

		public function registrarProducto($form){ 
			$pro_nombre=$form['nombre'];
			$pro_precio=$form['precio'];
			$pro_tiempo=$form['tiempo'];
			$ing_id=$form['ides'];
			$cantidad=$form['cant'];
			$Sucursal=$form['selectSucursal'];

			$link = new BaseDatos();

			$siexiste=$link->select_query("SELECT * FROM producto WHERE pro_nombre = '$pro_nombre'");
			
			if ($siexiste == null){
				$consulta=$link->insert_query("INSERT INTO producto(pro_nombre, pro_precio, pro_tiempo, suc_id)
	    									   VALUES ('$pro_nombre',$pro_precio,$pro_tiempo,'$Sucursal')");
				
				$consultados=$link->select_query("SELECT pro_id FROM producto ORDER BY pro_id DESC LIMIT 1");
				$idprod=$consultados[0]->pro_id;

				for($i=0; $i<sizeof($ing_id); $i++){
					$iding=$ing_id[$i];
					$cant=$cantidad[$i];
					
					if($cant != 0 ){
						$consulta=$link->insert_query("INSERT INTO consume(pro_id, ing_id, con_cantidad)
	    												VALUES ($idprod, $iding, $cant)");
					}
				}
			}
			else
				$consulta=false;
				
			return $consulta;
		}

		public function actualizar($id,$data){
			$link = new BaseDatos();
			$sql = "UPDATE producto SET pro_nombre ='{nombre}', pro_precio='{precio}', pro_tiempo='{tiempo}' WHERE pro_id='$id'";
			$sql = str_replace("{nombre}", $data["nombre"], $sql);
			$sql = str_replace("{precio}", $data["precio"], $sql);
			$sql = str_replace("{tiempo}", $data["tiempo"], $sql);
			$response = $link->insert_query($sql);

			if(isset($data['aeliminar'])){
				$aeliminar=$data['aeliminar'];
			}
			if(isset($data['ides'])){
				$ing_id=$data['ides'];
			}
			if(isset($data['cant'])){
				$cantidad=$data['cant'];
			}
			
			if(isset($data['aeliminar'])){
				for($i=0; $i<sizeof($aeliminar); $i++){
					$id_elim=$aeliminar[$i];
					$consulta=$link->insert_query("DELETE FROM consume WHERE ing_id=$id_elim AND pro_id=$id");
				}
			}
	
			for($i=0; $i<sizeof($ing_id); $i++){
				$iding=$ing_id[$i];
				$cant=$cantidad[$i];
				if(isset($data['aeliminar'])){
					if(!in_array($iding, $aeliminar)){
						$consulta=$link->insert_query("UPDATE consume SET con_cantidad = $cant WHERE ing_id=$iding AND pro_id=$id");
					}
				}
				else{
					if($cant != 0)
						$consulta=$link->insert_query("UPDATE consume SET con_cantidad = $cant WHERE ing_id=$iding AND pro_id=$id");
					else
						$consulta=$link->insert_query("DELETE FROM consume WHERE ing_id=$iding AND pro_id=$id");
				}	
			}
			$ing_id=$data['idesotro'];
			$cantidad=$data['cantotro'];
			for($i=0; $i<sizeof($ing_id); $i++){
				$iding=$ing_id[$i];
				$cant=$cantidad[$i];
				if($cant != 0 ){
					$consulta=$link->insert_query("INSERT INTO consume(pro_id, ing_id, con_cantidad)
    												VALUES ($id, $iding, $cant);");
				}
			}
			return $response;
		}
	}
?>