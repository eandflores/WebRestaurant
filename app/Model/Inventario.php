<?php
	App::uses('BaseDatos','Vendor');

	class Inventario extends AppModel{ 
		public function insertar($form){ 
			$Nombre=$form['Nombre'];
			$Precio=$form['Precio'];
			$Medida=$form['selectMedida'];
			$Stock=$form['Stock'];
			$Proveedor=$form['Proveedor'];
			$Sucursal=$form['selectSucursal'];

			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT * FROM ingrediente WHERE ing_nombre='$Nombre'");

			if($consulta==null){
				if($Medida=="KILO" || $Medida=="LITRO" || $Medida=="UNIDAD"){
					$Precio=$Precio/$Stock;
					$consulta2=$link->insert_query("INSERT INTO ingrediente(ing_nombre,ing_precio,ing_medida,ing_stock,ing_proveedor,suc_id,ing_entradas) 
					VALUES('$Nombre','$Precio','$Medida','$Stock','$Proveedor','$Sucursal',1)");
				}
				elseif($Medida=="GRAMO"){
					$Stock=$Stock*0.001;
					$Precio=$Precio/$Stock;
					$consulta2=$link->insert_query("INSERT INTO ingrediente(ing_nombre,ing_precio,ing_medida,ing_stock,ing_proveedor,suc_id,ing_entradas) 
					VALUES('$Nombre','$Precio','KILO','$Stock','$Proveedor','$Sucursal',1)");
				}
				elseif($Medida=="CC"){
					$Stock=$Stock*0.001;
					$Precio=$Precio/$Stock;
					$consulta2=$link->insert_query("INSERT INTO ingrediente(ing_nombre,ing_precio,ing_medida,ing_stock,ing_proveedor,suc_id,ing_entradas) 
					VALUES('$Nombre','$Precio','LITRO','$Stock','$Proveedor','$Sucursal',1)");
				}				
			}
			else
				$consulta2=false;

			return $consulta2;
		}

		public function modificar($form,$Id){ 
			$PrecioViejo=$form['Precio1'];
			$PrecioNuevo=$form['Precio2'];
			$StockViejo=$form['Stock1'];
			$StockNuevo=$form['Stock2'];
			$Medida=$form['selectMedida'];
			$Entradas=$form['Entradas'];

			$link = new BaseDatos();

			if($Medida=="KILO" || $Medida=="LITRO" || $Medida=="UNIDAD"){
				$PrecioNuevo=$PrecioNuevo/$StockNuevo;
				$Stock=$StockNuevo+$StockViejo;

				$Precio=($PrecioViejo*$Entradas)+$PrecioNuevo;
				$Precio=$Precio/($Entradas+1);

				$consulta2=$link->insert_query("UPDATE ingrediente 
							SET ing_precio='$Precio',ing_medida='$Medida',ing_stock='$Stock',ing_entradas='$Entradas'+1 
							WHERE ing_id='$Id'");
			}
			elseif($Medida=="GRAMO"){
				$StockNuevo=$StockNuevo*0.001;
				$PrecioNuevo=$PrecioNuevo/$StockNuevo;
				$Stock=$StockNuevo+$StockViejo;

				$Precio=($PrecioViejo*$Entradas)+$PrecioNuevo;
				$Precio=$Precio/($Entradas+1);

				$consulta2=$link->insert_query("UPDATE ingrediente 
							SET ing_precio='$Precio',ing_medida='KILO',ing_stock='$Stock',ing_entradas='$Entradas'+1 
							WHERE ing_id='$Id'");
			}
			elseif($Medida=="CC"){
				$StockNuevo=$StockNuevo*0.001;
				$PrecioNuevo=$PrecioNuevo/$StockNuevo;
				$Stock=$StockNuevo+$StockViejo;

				$Precio=($PrecioViejo*$Entradas)+$PrecioNuevo;
				$Precio=$Precio/($Entradas+1);
				
				$consulta2=$link->insert_query("UPDATE ingrediente 
							SET ing_precio='$Precio',ing_medida='LITRO',ing_stock='$Stock',ing_entradas='$Entradas'+1 
							WHERE ing_id='$Id'");
			}
			
			return $consulta2;
		}

		public function modificar2($form,$Id){ 
			$StockViejo=$form['Stock1'];
			$StockNuevo=$form['Stock2'];
			$Medida=$form['selectMedida'];

			$link = new BaseDatos();

			if($Medida=="KILO" || $Medida=="LITRO" || $Medida=="UNIDAD"){
				$Stock=$StockViejo-$StockNuevo;

				$consulta2=$link->insert_query("UPDATE ingrediente 
							SET ing_medida='$Medida',ing_stock='$Stock' 
							WHERE ing_id='$Id'");
			}
			elseif($Medida=="GRAMO"){
				$StockNuevo=$StockNuevo*0.001;
				$Stock=$StockViejo-$StockNuevo;

				$consulta2=$link->insert_query("UPDATE ingrediente 
							SET ing_medida='KILO',ing_stock='$Stock' 
							WHERE ing_id='$Id'");
			}
			elseif($Medida=="CC"){
				$StockNuevo=$StockNuevo*0.001;
				$Stock=$StockViejo-$StockNuevo;
				
				$consulta2=$link->insert_query("UPDATE ingrediente 
							SET ing_medida='LITRO',ing_stock='$Stock' 
							WHERE ing_id='$Id'");
			}
			
			return $consulta2;
		}

		public function mostrar(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM ingrediente ORDER BY ing_nombre");
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
			$consulta=$link->select_query("SELECT * FROM ingrediente WHERE suc_id='$sucursal' ORDER BY ing_nombre");
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

		public function buscar($Id){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM ingrediente WHERE ing_id='$Id'");

			return $consulta;
		}

		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("DELETE FROM ingrediente WHERE ing_id='$Id'");

			return $consulta;
		}
	}
?>