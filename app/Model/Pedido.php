<?php
	App::uses('BaseDatos','Vendor');

	class Pedido extends AppModel{ 
		
		//Comentada por mi

		// public function insertar($form){ 
		// 	$Nombre=$form['Nombre'];
		// 	$Precio=$form['Precio'];
		// 	$Medida=$form['selectMedida'];
		// 	$Stock=$form['Stock'];
		// 	$Proveedor=$form['Proveedor'];
		// 	$Sucursal=$form['selectSucursal'];

		// 	$link = new BaseDatos();

		// 	$consulta=$link->select_query("SELECT * FROM ingrediente WHERE ing_nombre='$Nombre'");

		// 	if($consulta==null)
		// 		$consulta2=$link->insert_query("INSERT INTO ingrediente(ing_nombre,ing_precio,ing_medida,ing_stock,ing_proveedor,suc_id) 
		// 		VALUES('$Nombre','$Precio','$Medida','$Stock','$Proveedor','$Sucursal')");
		// 	else
		// 		$consulta2=false;

		// 	return $consulta2;
		// }

		//Busca mesas con pedidos estado pendiente
		public function getMP($su){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM pedido p, mesa m where p.mes_id=m.mes_id and m.suc_id='$su' and p.ped_estado='PENDIENTE' and m.mes_numero != -1 order by p.ped_hora,m.mes_id asc" );
			return $consulta;
		}


		public function estado($datos){
			$pedido=$datos["pedido"];
			$link = new BaseDatos();
			$con=$link->select_query("SELECT * from pedido where ped_id='$pedido' and ped_estado='PENDIENTE'");
			return $con;
		}

		public function mostrar(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM pedido ORDER BY ped_hora");
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
			$consulta=$link->select_query("SELECT * FROM pedido WHERE suc_id='$sucursal' ORDER BY ped_hora");
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
		public function modificar($form,$Id){ 
			$Nombre=$form['Nombre'];
			$Precio=$form['Precio'];
			$Medida=$form['Medida'];
			$Stock=$form['Stock'];

			$link = new BaseDatos();

			
			$consulta=$link->insert_query("UPDATE ingrediente 
							SET ing_nombre='$Nombre',ing_precio='$Precio',ing_medida='$Medida',ing_stock='$Stock' 
							WHERE ing_id='$Id'");
			
			return $consulta;
		}

		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("DELETE FROM ingrediente WHERE ing_id='$Id'");

			return $consulta;
		}

		public function getM(){
			$link = new BaseDatos();
			$su=$_SESSION["usuario"]->suc_id;
			$consulta=$link->select_query("SELECT * FROM  mesa  where mes_estado='false' and suc_id='$su'   order by mes_numero" );
			//and p.ped_estado='false'
			return $consulta;
		}

		public function getProductos(){
			$db = new BaseDatos();
			//$usuario=$_SESSION["usuario"]->tra_rut;
			$su=$_SESSION["usuario"]->suc_id;
			//$consulta=$db->select_query("SELECT caj_id FROM abre WHERE tra_rut='$usuario'");
			
			//$caja=$consulta[0]->caj_id;
			//return $db->select_query("SELECT * FROM producto WHERE suc_id = (SELECT suc_id FROM caja WHERE caj_id='$caja')");
			return $db->select_query("SELECT * FROM producto WHERE suc_id='$su'");
		}

		public function getPromociones(){
			$db = new BaseDatos();
			//$usuario=$_SESSION["usuario"]->tra_rut;

			//$consulta=$db->select_query("SELECT caj_id FROM abre WHERE tra_rut='$usuario'");
			
			//$caja=$consulta[0]->caj_id;
			//return $db->select_query("SELECT * FROM menu WHERE suc_id = (SELECT suc_id FROM caja WHERE caj_id='$caja')");
			$su=$_SESSION["usuario"]->suc_id;
			return $db->select_query("SELECT * FROM menu WHERE suc_id = '$su'");
		}
		public function generar_pedido($datos){
			//print_r($datos);
			$db = new BaseDatos();
			$prods = $datos["productos"];
			//$prod=$prods;
			$promos = $datos["promociones"];
			//$prom=$promos;
			$mesa=$datos["mesa"];
			//echo $mesa;
			$total = 0;
			if($mesa){
				$sql = "SELECT max(ven_id) as id FROM venta WHERE ven_estado='PENDIENTE' and mes_id='$mesa'";
				$r = $db->select_query($sql);
				$venta_id=$r[0]->id;
				//echo $venta_id;
				$totalprods=0;$totalpromos=0;$total=0;
				if($r){
					$totalprods=0;$totalpromos=0;$total=0;
					foreach ($prods as $key => $value) {
						if(isset($value["id"])){
							$sql = "SELECT pro_precio FROM producto WHERE pro_id=".$value["id"];
							$r1 = $db->select_query($sql);
							$totalprods += ($r1[0]->pro_precio * $value["cantidad"]);
						}
					}
					foreach ($promos as $key => $value) {
						if(isset($value["id"])){
							$sql = "SELECT * FROM posee p, producto t WHERE p.pro_id=t.pro_id and p.men_id=".$value["id"];
							$r2 = $db->select_query($sql);
							if($r2){
								foreach ($r2 as $key => $val) {
									if(isset($val["id"])){
										$sql = "SELECT pro_precio FROM producto WHERE pro_id=".$val["id"];
										$r2 = $db->select_query($sql);
										$totalpromos += ($r2[0]->pro_total * $value["cantidad"]);
									}
								}
							}
						}
					}
					//$total=300;
					
					$hora=date("H:i",time()-3600);
					//actualizo la venta
					$sql = "UPDATE venta 
							SET ven_total=ven_total + '$total' 
							WHERE ven_id='$venta_id' ";
					$r2 = $db->insert_query($sql);
					//agrego el pedido
					$sql = "INSERT INTO pedido(ped_total,ven_id,mes_id,ped_hora,ped_estado) 
					VALUES('$total','$venta_id','$mesa','$hora','PENDIENTE')";
					$r2 = $db->insert_query($sql);
					if(!$r2){
						$sql = "UPDATE venta 
							SET ven_total=ven_total-'$total' 
							WHERE ven_id='$venta_id'";
						$r2 = $db->insert_query($sql);
					}
					else return true;


				}else return false;
			}
			else return false;

		}

		public function comprar($form){ 
			if(isset($form['cantidadproducto']))
				$cantidadproducto=$form['cantidadproducto'];
			if(isset($form['idproducto']))
				$idproducto=$form['idproducto'];

			if(isset($form['cantidadpromocion']))
				$cantidadpromocion=$form['cantidadpromocion'];
			if(isset($form['idpromocion']))
				$idpromocion=$form['idpromocion'];
			
			$mediodepago=$form['mediopago'];
			$sucursal=$form['sucursal'];
			$caja = "PENDIENTE"; //Ya que la venta aun no pasa por ninguna caja
			$mesa= $form['mesa'];
			$fecha = date("d-m-y");
			$suma = 0;
			$user= $form['cliente'];

			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT * FROM caja WHERE caj_nombre = '$caja'");
			$caja=$consulta[0]->caj_id;
			
			if(isset($cantidadproducto)){
				for($i=0; $i<sizeof($cantidadproducto); $i++){
					$idprod=$idproducto[$i];
					$canprod=$cantidadproducto[$i];
					if($canprod != 0){
						$consulta=$link->select_query("SELECT pro_precio FROM producto WHERE pro_id = '$idprod'");
						$suma = $suma + ($canprod*($consulta[0]->pro_precio));
					}
				}
			}

			if(isset($cantidadpromocion)){
				for($i=0; $i<sizeof($cantidadpromocion); $i++){
					$idprom=$idpromocion[$i];
					$canprom=$cantidadpromocion[$i];
					if($canprom != 0){
						$consulta=$link->select_query("SELECT men_total FROM menu WHERE men_id = '$idprom'");
						$suma = $suma + ($canprom*($consulta[0]->men_total));
					}
				}
			}

			$consulta=$link->insert_query("UPDATE mesa SET mes_estado=false WHERE mes_id='$mesa'");

			$consulta=$link->insert_query("INSERT INTO venta( caj_id, cli_rut, ven_estado, mes_id, ven_total, ven_fecha,ven_mediopago)
    		VALUES ('$caja', '$user', 'PENDIENTE', '$mesa', '$suma', '$fecha','$mediodepago')");

			$consulta2=$link->select_query("SELECT ven_id FROM venta ORDER BY ven_id DESC LIMIT 1");
			$ven_id = $consulta2[0]->ven_id;

			$EstadoPedido="PENDIENTE";
			$Hora=$hora=date("H:i:s");

			$consulta2=$link->insert_query("INSERT INTO pedido(ven_id,mes_id,ped_total,ped_estado,ped_hora) 
				VALUES('$ven_id','$mesa','$suma','$EstadoPedido','$Hora')");
			
			$consulta3=$link->select_query("SELECT ped_id FROM pedido ORDER BY ped_id DESC LIMIT 1");
			$ped_id = $consulta3[0]->ped_id;

			$consulta3=null;
			if(isset($cantidadproducto)){
				for($i=0; $i<sizeof($cantidadproducto); $i++){
					$idprod=$idproducto[$i];
					$canprod=$cantidadproducto[$i];
					if($canprod != 0){
						$consulta3=$link->insert_query("INSERT INTO cuenta(pro_id, ped_id) VALUES ($idprod,$ped_id)");
					}
				}
			}

			$consulta4=null;
			if(isset($cantidadpromocion)){
				for($i=0; $i<sizeof($cantidadpromocion); $i++){
					$idprom=$idpromocion[$i];
					$canprom=$cantidadpromocion[$i];
					if($canprom != 0){
						$consulta4=$link->insert_query("INSERT INTO tiene(men_id, ped_id) VALUES ($idprom,$ped_id)");
					}
				}
			}

			if($consulta!=null && $consulta2!=null)
				return true;
			else
				return false;
		}

		//add2
		public function mostrarProductos($form){ 
			$sucursal=$_SESSION["usuario"]->suc_id;
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM producto WHERE suc_id='$sucursal' ORDER BY pro_nombre");
			
			return $consulta;
		}
		public function mostrarPromociones($form){ 
			$sucursal= $_SESSION["usuario"]->suc_id;
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM menu WHERE men_estado='t' AND suc_id='$sucursal' ORDER BY men_nombre");
			return $consulta;
		}
		public function pedir($form){ 
			if(isset($form['cantidadproducto']))
				$cantidadproducto=$form['cantidadproducto'];
			if(isset($form['idproducto']))
				$idproducto=$form['idproducto'];

			if(isset($form['cantidadpromocion']))
				$cantidadpromocion=$form['cantidadpromocion'];
			if(isset($form['idpromocion']))
				$idpromocion=$form['idpromocion'];
			$banderita=0;
			if(isset($cantidadproducto)){
				for($i=0; $i<sizeof($cantidadproducto); $i++){
					$canprod=$cantidadproducto[$i];
					if($canprod != 0)$banderita=1;
				}
			}
			if(isset($cantidadpromocion)){
				for($i=0; $i<sizeof($cantidadpromocion); $i++){
					$canprom=$cantidadpromocion[$i];
					if($canprom != 0)$banderita=1;
				}
			}
			if($banderita!=1)return false;
			else{
				$mesa=$form["mesa"];
				$caja = "PENDIENTE";
				$fecha = date("d-m-y");
				$suma = 0;
				$link = new BaseDatos();
				if(isset($cantidadproducto)){
					for($i=0; $i<sizeof($cantidadproducto); $i++){
						$idprod=$idproducto[$i];
						$canprod=$cantidadproducto[$i];
						if($canprod != 0){
							$consulta=$link->select_query("SELECT pro_precio FROM producto WHERE pro_id = '$idprod'");
							$suma = $suma + ($canprod*($consulta[0]->pro_precio));
						}
					}
				}
				if(isset($cantidadpromocion)){
					for($i=0; $i<sizeof($cantidadpromocion); $i++){
						$idprom=$idpromocion[$i];
						$canprom=$cantidadpromocion[$i];
						if($canprom != 0){
							$consulta=$link->select_query("SELECT men_total FROM menu WHERE men_id = '$idprom'");
							$suma = $suma + ($canprom*($consulta[0]->men_total));
						}
					}
				}
				if($mesa){
					$sql = "SELECT max(ven_id) as id FROM venta WHERE ven_estado='PENDIENTE' and mes_id='$mesa'";
					$r = $link->select_query($sql);
					$venta_id=$r[0]->id;
					if($r){

						$hora=date("H:i",time()-3600);

						//actualizo la venta
						$sql = "UPDATE venta 
								SET ven_total=ven_total + '$suma' 
								WHERE ven_id='$venta_id' ";
						$r2 = $link->insert_query($sql);

						//agrego el pedido
						$sql = "INSERT INTO pedido(ped_total,ven_id,mes_id,ped_hora,ped_estado) 
						VALUES('$suma','$venta_id','$mesa','$hora','PENDIENTE')";
						$r2 = $link->insert_query($sql);
						if(!$r2){
							$sql = "UPDATE venta 
								SET ven_total=ven_total-'$suma' 
								WHERE ven_id='$venta_id'";
							$r2 = $link->insert_query($sql);
							return false;
						}
						else{
							$sql = "SELECT max(ped_id) as id FROM pedido WHERE ped_estado='PENDIENTE' and mes_id='$mesa' and ped_hora='$hora' and ven_id='$venta_id'";
							$r = $link->select_query($sql);
							$ped_id=$r[0]->id;

							$consulta3=null;
							if(isset($cantidadproducto)){
								for($i=0; $i<sizeof($cantidadproducto); $i++){
									$idprod=$idproducto[$i];
									$canprod=$cantidadproducto[$i];
									if($canprod != 0){
										$consulta3=$link->insert_query("INSERT INTO cuenta(pro_id, ped_id) VALUES ($idprod,$ped_id)");
									}
								}
							}

							$consulta4=null;
							if(isset($cantidadpromocion)){
								for($i=0; $i<sizeof($cantidadpromocion); $i++){
									$idprom=$idpromocion[$i];
									$canprom=$cantidadpromocion[$i];
									if($canprom != 0){
										$consulta4=$link->insert_query("INSERT INTO tiene(men_id, ped_id) VALUES ($idprom,$ped_id)");
									}
								}
							}

						}return true;


					}else return false;
				}
				else return false;

				return true;
			}
		}

		public function estado2($su){
			$link = new BaseDatos();
			$con=$link->select_query("SELECT p.ped_id,m.mes_numero,p.ped_hora from pedido p, mesa m where p.mes_id=m.mes_id and m.mes_numero != -1 and m.suc_id='$su' and p.ped_estado='PENDIENTE' order by p.ped_hora asc");
			return $con;
		}

		//Cambia estado a producto
		public function aceptada($datos){
			$pedido=$datos["pedido"];
			$suc=$datos["su"];
			$link = new BaseDatos();
			$consulta=$link->insert_query("UPDATE pedido 
										SET ped_estado= 'ENTREGADO' 
										WHERE ped_id='$pedido' ");
			
			if($consulta){
				$con=$link->select_query("SELECT * FROM pedido p, cuenta cu, consume co, ingrediente i where p.ped_id=cu.ped_id and cu.pro_id=co.pro_id and co.ing_id=i.ing_id and p.ped_id='$pedido' and i.suc_id='$suc'");
				return $con;
			}
			else 
				return null;
		}

		public function aceptamenu($datos){
			$pedido=$datos["pedido"];
			$suc=$datos["su"];
			$link = new BaseDatos();

			$con=$link->select_query("SELECT * FROM pedido p, tiene t,posee e , consume c, ingrediente i where p.ped_id=t.ped_id and t.men_id=e.men_id and e.pro_id=c.pro_id and c.ing_id=i.ing_id and p.ped_id='$pedido' and i.suc_id='$suc'");
			
			return $con;
		}

		public function descontar($ing,$cant,$numero){
			$link = new BaseDatos();
			$total=$cant*$numero;

			$consulta=$link->insert_query("UPDATE ingrediente 
										SET ing_stock= ing_stock-'$total' 
										WHERE ing_id='$ing' ");
			
			return $consulta;
		}

		public function eliminarpedido($Id){
			echo $Id;
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT v.ven_fecha,p.ped_hora,v.ven_total,p.ped_id,p.ped_total,v.ven_id,p.ped_estado,n.men_id,pr.pro_id
			from venta v LEFT JOIN pedido p ON (v.ven_id=p.ven_id)
			LEFT JOIN tiene t ON (p.ped_id=t.ped_id)
			LEFT JOIN cuenta c ON (p.ped_id=c.ped_id )
			where  v.ven_estado='PENDIENTE'  and p.ped_id='$Id' ORDER BY v.ven_id ");

			if($consulta){
				/*$elim=$consulta;
				foreach ($consulta as $key => $val) {
									$venta=$val["ven_id"];
									$total=$val["ped_total"];
				}*/
				$venta=$consulta[0]->ven_id;
				$total=$consulta[0]->ven_total;
				$pedido=$consulta[0]->ped_id;

				//restar pedido a la venta
				$sql = "UPDATE venta 
						SET ven_total=ven_total-'$total' 
						WHERE ven_id='$venta'";
				$r2 = $link->insert_query($sql);
				if(!$r2)return false; // si no se resto 

				$sql = "SELECT ven_total as ven FROM venta WHERE ven_id='$venta'";
				$r = $link->select_query($sql);

				$venta_total=$r[0]->ven;
				if($venta_total==0){
					//eliminar venta por estar en 0
					$sql = "DELETE FROM venta WHERE ven_id='$venta'";
					$r2 = $link->insert_query($sql);
				}
				//elimino menus y productos asociados!
				foreach ($consulta as $key => $val) {
					if($val["men_id"]){//existe menu asociado al pedido -> eliminar!
						$menu=$val["men_id"];
						$sql = "DELETE FROM tiene WHERE ped_id='$pedido'and men_id='$menu'";
						$r2 = $link->insert_query($sql);
					}
					if($val["pro_id"]){//existe producto asociado al pedido -> eliminar!
						$prod=$val["pro_id"];
						$sql = "DELETE FROM cuenta WHERE ped_id='$pedido'and pro_id='$prod'";
						$r2 = $link->insert_query($sql);
					}
				}
				//finalmente elimino el pedido asociado
				$sql = "DELETE FROM pedido WHERE ped_id='$pedido'";
				$r2 = $link->insert_query($sql);
				if($r2)return true;
				return false;
			}
			else return false;
		}
	}
?>