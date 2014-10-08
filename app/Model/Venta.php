<?php 
	App::uses("BaseDatos", "Vendor");

	class Venta extends AppModel{

		//Muestra la cajas a excepción de la de pedidos a domicilio
		public function getCajas($suc_id){
			$db = new BaseDatos();

			$sql = "SELECT caj_id FROM caja WHERE suc_id='$suc_id' and caj_nombre != 'PENDIENTE' EXCEPT (SELECT caj_id FROM abre)";
			$response = $db->select_query($sql);
			
			if(is_null($response)){
				return array();
			}else{
				return $response;
			}
		}

		//Revisa que la caja este abierta
		public function chequear(){
			$db = new BaseDatos();

			$usuario=$_SESSION["usuario"]->tra_rut;

			$consulta = $db->select_query("SELECT caj_id FROM abre WHERE tra_rut='$usuario'");
			
			return $consulta;
		}

		//Abre la caja
		public function AbrirCaja($datos){
			$db = new BaseDatos();

			$sql = "INSERT INTO abre VALUES('{caj_id}','{tra_rut}')";
			
			$sql = str_replace("{caj_id}", $datos["caj_id"], $sql);
			$sql = str_replace("{tra_rut}", $_SESSION["usuario"]->tra_rut, $sql);
			
			if($db->insert_query($sql)){
				return array($datos["caj_id"], $_SESSION["usuario"]->tra_rut);
			}else{
				return array();
			}
		}

		//Cierra la caja
		public function CerrarCaja(){
			$db = new BaseDatos();
			$usuario=$_SESSION["usuario"]->tra_rut;

			return $db->insert_query("DELETE FROM abre WHERE tra_rut='$usuario'");
		}

		//Mesas con estado true (Habilitadas)
		public function mesas($su){
			$link = new BaseDatos();
			$consulta = $link->select_query("SELECT * FROM mesa where suc_id='$su' and mes_estado='t' and mes_numero != -1 order by mes_numero" );
			return $consulta;
		}

		//Mesas con estado false (Ocupadas)
		public function getMesas($su){
			$link = new BaseDatos();
			$consulta = $link->select_query("SELECT * FROM mesa where suc_id='$su' and mes_estado='f' order by mes_numero" );
			return $consulta;
		}

		//Deja la venta como REALIZADA si no tiene pedidos ene spera
		public function aceptada($datos){
			$link = new BaseDatos();
			$mesa = $datos['mesa'];

			$consulta = $link->select_query("SELECT v.ven_id FROM venta v, pedido p WHERE p.ven_id = v.ven_id and p.ped_estado = 'PENDIENTE' and v.mes_id = '$mesa'"); 
			
			if(is_null($consulta)){
				$consulta2 = $link->insert_query("UPDATE venta set ven_estado='REALIZADA' WHERE mes_id='$mesa'");
				$consulta3 = $link->insert_query("UPDATE mesa set mes_estado=true WHERE mes_id='$mesa'");
			}
			else{
				$consulta2=null;
				$consulta3=null;
			}
			return $consulta2;
		}

		//Ventas pendientes
		public function estado($su){
			$link = new BaseDatos();
			$con=$link->select_query("SELECT * from venta v, mesa m where v.mes_id=m.mes_id and v.ven_estado='PENDIENTE' and m.suc_id='$su' and m.mes_numero != -1 order by v.ven_id asc");
			return $con;
		}

		//Ventas pendientes
		public function estado2($su){
			$link = new BaseDatos();
			$con=$link->select_query("SELECT * from venta v, mesa m where v.mes_id=m.mes_id and v.ven_estado!='PENDIENTE' and m.suc_id='$su' and m.mes_numero != -1 order by v.ven_id asc");
			return $con;
		}

		public function getSucursalByCaja($caj_id){
			$db = new BaseDatos();
			return $db->select_query("SELECT suc_id FROM caja WHERE caj_id=$caj_id");
		}

		public function getProductos(){
			$db = new BaseDatos();
			$usuario=$_SESSION["usuario"]->tra_rut;

			$consulta=$db->select_query("SELECT caj_id FROM abre WHERE tra_rut='$usuario'");
			
			$caja=$consulta[0]->caj_id;
			return $db->select_query("SELECT * FROM producto WHERE suc_id = (SELECT suc_id FROM caja WHERE caj_id='$caja')");
		}

		public function getPromociones(){
			$db = new BaseDatos();
			$usuario=$_SESSION["usuario"]->tra_rut;

			$consulta=$db->select_query("SELECT caj_id FROM abre WHERE tra_rut='$usuario'");
			
			$caja=$consulta[0]->caj_id;
			return $db->select_query("SELECT * FROM menu WHERE suc_id = (SELECT suc_id FROM caja WHERE caj_id='$caja')");
		}

		public function consulta_stock($pro_id, $cantidad, $tipo){
			$db = new BaseDatos();
			switch ($tipo) {
				case 1:
					// PARA PRODUCTOS
					$sql = "SELECT * FROM consume WHERE pro_id = $pro_id";
					$response = $db->select_query($sql);
					$flag = true;
					foreach ($response as $key => $value) {
						$utiliza = $value->com_cantidad * $cantidad;
						$sql = "SELECT ing_stock FROM ingrediente WHERE ing_id = ".$value->ing_id;
						$r = $db->select_query($sql);
						if($r[0]->ing_stock < $utiliza){
							$flag = false;
							break;
						}
					}
					return $flag;
					break;
				
				case '2':
					// PARA PROMOCIONES
					$flag = true;
					$sql = "SELECT * FROM tiene WHERE prom_id = $pro_id";
					$productos = $db->select_query($sql);
					foreach ($productos as $key => $value) {
						$sql = "SELECT * FROM consume WHERE pro_id=".$value->prod_id;
						$ingredientes = $db->select_query($sql);
						foreach ($ingredientes as $k_ing => $ing_value) {
							$sql = "SELECT ing_stock FROM ingrediente WHERE ing_id =".$ing_value->ing_id;
							$r = $db->select_query($sql);
							if($r[0]->ing_stock < ($cantidad * $value->tie_cantidad)){
								$flag = false;
								break;
							}
						}
						if(!$flag){
							break;
						}
					}
					return $flag;
					break;
			}
		}

		public function getClientesPendientes($caj_id){
			$sql = "SELECT * FROM cliente WHERE cli_rut IN (SELECT C.cli_rut FROM compra C, venta V WHERE V.ven_estado='PENDIENTE' AND V.ven_id = C.ven_id AND V.caj_id=$caj_id)";
			$db = new BaseDatos();
			return $db->select_query($sql);
		}

		public function generar_venta($datos){
			print_r($datos);
			$db = new BaseDatos();
			$prods = $datos["productos"];
			$promos = $datos["promociones"];
			$total = 0;
			foreach ($prods as $key => $value) {
				if(isset($value["id"])){
					$sql = "SELECT pro_precio FROM producto WHERE pro_id=".$value["id"];
					$r = $db->select_query($sql);
					$total += ($r[0]->pro_precio * $value["cantidad"]);
				}
			}
			foreach ($promos as $key => $value) {
				if(isset($value["id"])){
					$sql = "SELECT pro_total FROM promocion WHERE pro_id=".$value["id"];
					$r = $db->select_query($sql);
					$total += ($r[0]->pro_total * $value["cantidad"]);
				}
			}
			$sql = "INSERT INTO VENTA(caj_id, ven_estado, ven_total, ven_fecha, ven_descripcion, ven_mediooago) ";
			$sql .= "VALUES({caja},'PROCESO',{total},'{fecha}','{descripcion}','{ven_mediopago}') RETURNING ven_id ";
			$medio = "";
			$f = new DateTime();
			switch($datos["mp"]){
				case 1:
						$medio = "EFECTIVO";
						break;
				case 2:
						$medio = "TARJETA";
						break;
				case 3:
						$medio = "CHEQUE";
						break;
			}
			$sql = str_replace("{caja}", $datos["caj_id"], $sql);
			$sql = str_replace("{fecha}", $f->format("Y-m-d"), $sql);
			$sql = str_replace("{descripcion}", $datos["descripcion"], $sql);
			$sql = str_replace("{ven_mediopago}", $medio, $sql);
			$sql = str_replace("{total}", $total, $sql);
			$id = $db->select_query($sql);
			if(is_array($id)){		
				$this->venta_productos($datos["productos"], $id[0]->ven_id);
				$this->venta_promos($datos["promociones"], $id[0]->ven_id);
				return array(
					"total" => $total,
					"id" => $id,
					"medio_pago" => $medio,
					"tiempo_estimado" => $this->calcular_tiempo()
				);
			}else{
				return false;
			}
		}

		private function venta_productos($prods, $id){
			$db = new BaseDatos();
			foreach ($prods as $key => $value) {
				if(isset($value["id"])){
					$sql = "INSERT INTO venta_producto VALUES(".$value["id"].",$id, ".$value["cantidad"].")";
					$db->insert_query($sql);
				}
			}
		}

		private function venta_promos($promos, $id){
			$db = new BaseDatos();
			foreach ($promos as $key => $value) {
				if(isset($value["id"])){
					$sql = "INSERT INTO venta_promocion VALUES(".$value["id"].",$id, ".$value["cantidad"].")";
					$db->insert_query($sql);
				}
			}
		}

		private function calcular_tiempo(){
			$db = new BaseDatos();
			$sql = "SELECT * FROM venta WHERE ven_estado ='PROCESO'";
			$r = $db->select_query($sql);
			$tiempo = 0;
			foreach ($r as $key => $value) {
				$sql = "SELECT * FROM venta_producto WHERE ven_id=".$value->ven_id;
				$aux = $db->select_query($sql);
				if(!is_null($aux)){
					foreach ($aux as $k_listado => $listado) {
						$sql = "SELECT pro_tiempoprep FROM producto WHERE pro_id=".$listado->pro_id;
						$tmp = $db->select_query($sql);
						foreach ($tmp as $k_producto => $producto) {
							$tiempo += ($producto->pro_tiempoprep * $listado->ven_cantidad) ;
						}
					}
				}
			}
			foreach ($r as $key => $value) {
				$sql = "SELECT * FROM venta_promocion WHERE ven_id=".$value->ven_id;
				$aux = $db->select_query($sql);
				if(!is_null($aux)){
					foreach ($aux as $promociones => $promos) {
						$sql = "SELECT * FROM tiene WHERE prom_id=".$promos->pro_id;
						$tmp = $db->select_query($sql);
						foreach ($tmp as $k_prod => $productos) {
							$sql = "SELECT pro_tiempoprep FROM producto WHERE pro_id=".$productos->prod_id;
							$h = $db->select_query($sql);
							$tiempo += $h[0]->pro_tiempoprep * $productos->tie_cantidad * $promos->ven_cantidad;
						}
					}
				}
			}
			return $tiempo;
		}

		public function getClientes(){
			$b = new BaseDatos();
			return $b->select_query("SELECT * FROM cliente");
		}

		public function detalles_envio($datos){
			$lod = $datos["ld"];
			if($lod == 0){
				return array("direccion" => "LOCAL");
			}else{
				if(isset($datos["cli_rut"])){
					
				}
			}
		}

		public function mostrarSucursal(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM sucursal ORDER BY suc_nombre;");
			return $consulta;
		}

		public function mostrarProductos($form){ 
			$sucursal=$form['sucursal'];
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM producto WHERE suc_id='$sucursal' ORDER BY pro_nombre");
			
			return $consulta;
		}
		public function mostrarPromociones($form){ 
			$sucursal=$form['sucursal'];
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM menu WHERE men_estado='t' AND suc_id='$sucursal' ORDER BY men_nombre");
			return $consulta;
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
			$fecha = date("Y-m-d");
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

		public function clientes(){
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT cli_rut FROM cliente ");
			return $consulta;
		}

		public function Pedidomenu($form){ 
			$mesa=$form['mesa'];
			echo $mesa;
			$suc = $_SESSION["usuario"]->suc_id;
			$hoy=date('Y-m-j');
			$link = new BaseDatos();
			//$consulta=$link->select_query("SELECT * FROM venta v, pedido p, mesa m, tiene t, menu n WHERE v.ven_id=p.ven_id and p.mes_id=m.mes_id and p.ped_id=t.ped_id and t.men_id=n.men_id and m.suc_id='$suc'and v.ven_fecha='$hoy' and v.ven_estado='PENDIENTE' ORDER BY v.ven_id");
			/*$consulta=$link->select_query("SELECT *
			from venta v LEFT JOIN pedido p ON (v.ven_id=p.ven_id)
			LEFT JOIN mesa m ON (p.mes_id=m.mes_id)
			LEFT JOIN tiene t ON (p.ped_id=t.ped_id)
			LEFT JOIN menu n ON (t.men_id=n.men_id ) 
			LEFT JOIN cuenta c ON (p.ped_id=c.ped_id )
			LEFT JOIN producto pr ON (c.pro_id=pr.pro_id )
			where  m.suc_id='$suc'and v.ven_fecha='$hoy' and v.ven_estado='PENDIENTE' ORDER BY v.ven_id ");*/

			$consulta=$link->select_query("SELECT v.ven_fecha,p.ped_hora,v.ven_total,p.ped_id,v.ven_id, m.mes_id,m.mes_numero,p.ped_estado,n.men_id,n.men_nombre,n.men_total,pr.pro_id,pr.pro_precio,pr.pro_nombre
			from venta v LEFT JOIN pedido p ON (v.ven_id=p.ven_id)
			LEFT JOIN mesa m ON (p.mes_id=m.mes_id)
			LEFT JOIN tiene t ON (p.ped_id=t.ped_id)
			LEFT JOIN menu n ON (t.men_id=n.men_id ) 
			LEFT JOIN cuenta c ON (p.ped_id=c.ped_id )
			LEFT JOIN producto pr ON (c.pro_id=pr.pro_id )
			where  m.suc_id='$suc' and v.ven_estado='PENDIENTE'  and m.mes_id='$mesa' ORDER BY v.ven_id ");

			return $consulta;
		}
		public function Pedidoproducto($form){ 
			$mesa=$form['mesa'];
			$suc = $_SESSION["usuario"]->suc_id;
			$hoy=date('Y-m-j');
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT * FROM venta v, pedido p, mesa m, cuenta c, producto pr WHERE v.ven_id=p.ven_id and p.mes_id=m.mes_id and p.ped_id=c.ped_id and c.pro_id=pr.pro_id and m.suc_id='$suc'and v.ven_fecha='$hoy' and v.ven_estado='PENDIENTE' ORDER BY v.ven_id");
			return $consulta;
		}
	}
?>