<?php
	App::uses('BaseDatos','Vendor');

	class Deusuario extends AppController{ 

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

		/*public function getdias(){
			$actual = date('Y-m-d');
		$nueva= date("Y-m-d", strtotime("$actual +7 day"));
		$miarray = array(); 
		$c=0;
		while($actual < $nueva){
    		$actual= date("Y-m-d", strtotime("$actual +1 day"));
    		$i = strtotime($actual);
 			$v=jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 );
 			if($v!=0 && $v!=6 ){
				$miarray[$c] = $actual;
				$c=$c+1;
 			}
		}			 
			$this->set("actual", $miarray);	
		}*/		

		public function sucursales(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT suc_id,suc_nombre FROM sucursal ORDER BY suc_nombre");
			return $consulta;
		}

		public function mireserva($usu){//ver como enviar rut??
			$link = new BaseDatos();
			$rut=$usu->cli_rut;// quiero recibir el rut
			$consulta=$link->select_query("SELECT * 
											FROM mesa m, reserva r,cliente c,sucursal s
											WHERE r.mes_id=m.mes_id and r.cli_rut=c.cli_rut and m.suc_id=s.suc_id and r.cli_rut='$rut' 
											");
			
			$tmp = array();
			if(is_null($consulta)){
				return array();
			}
			return $consulta;
		}

		public function reservar($datos){
			$link = new BaseDatos();
			
			$sucursal=$datos["sucursal"];
			$fecha=$datos["fecha"];
			$hora=$datos["hora"];

			$consulta=$link->select_query("SELECT distinct  m.mes_id, m.mes_numero, s.suc_id,s.suc_nombre
							FROM mesa m, sucursal s
							WHERE s.suc_id = m.suc_id and m.mes_estado=true
							and s.suc_id=$sucursal and m.mes_id not in(
								SELECT m.mes_id
								FROM mesa m, reserva r
								WHERE r.mes_id=m.mes_id and  m.suc_id=$sucursal  and r.res_fecha='$fecha' and r.res_hora='$hora'
							)");
			
			$tmp = array();

			if(is_null($consulta)){
				return null;
			}
			foreach ($consulta as $key => $value) {
				$value->fecha = $fecha;
				$value->hora = $hora;
				$tmp[] = $value;
			}
			
			return $tmp;
		}

		public function deleteres($Id) {
			$link = new BaseDatos();
			/*$consulta=$link->insert_query("select * FROM reserva WHERE res_id='$Id'");
			foreach ($consulta as $key => $value) {
			$fecha =$value->res_fecha;
			echo $fecha;			
			//$hora=date("Y-m-d", strtotime($consulta->res_fecha);
			$actual =date('Y-m-j H:i:s');
			echo$actual;
			$nuevafecha = strtotime ( '+24 hour' , strtotime ( $actual ) ) ;
			$nuevafecha = date ( 'Y-m-j H:i:s' , $nuevafecha );
			echo$nuevafecha;
			
			if($nuevafecha>$fecha){*/
			$actual =date('Y-m-j H:i:s');
			$nuevafecha = strtotime ( '+24 hour' , strtotime ( $actual ) ) ;
			$nuevafecha = date ( 'Y-m-j H:i:s' , $nuevafecha );
			$consulta=$link->insert_query("DELETE FROM reserva WHERE res_id='$Id' and res_fecha>'$nuevafecha'");
			return $consulta;
			//}
			//return false;
		//}
		}

		public function addres($mesa,$fecha,$hora,$rut){
			$link = new BaseDatos();

			$consulta=$link->insert_query("INSERT INTO 
				reserva(cli_rut,mes_id,res_fecha,res_hora,res_estado) 
				VALUES('$rut','$mesa','$fecha','$hora','false')");
			
			return $consulta;
		}

		public function registrarCliente($form){ 
			$rut=$form['rut'];
			$nombre=$form['nombre'];
			$apellido=$form['apellido'];
			$correo=$form['correo'];
			$telefono=$form['telefono'];
			$direccion=$form['direccion'];
			$contrasenia=md5($form['contrasenia']);
			$repcontrasenia=md5($form['repcontrasenia']);

			$link = new BaseDatos();
			if($contrasenia==$repcontrasenia){
				$consulta=$link->insert_query("INSERT INTO cliente(cli_rut,cli_nombre,cli_apellido,cli_correo,cli_telefono,cli_direccion,cli_password,cli_estado)
					VALUES('$rut','$nombre','$apellido','$correo','$telefono','$direccion','$contrasenia',true)");
			}
			else
				$consulta=false;

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
			$mesa= -1; //Pendiente
			$fecha = date("Y-m-d");
			$suma = 0;
			$user=$_SESSION['usuario']->cli_rut;

			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT caj_id FROM caja WHERE caj_nombre = '$caja'");
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

			$consulta2=$link->select_query("SELECT mes_id FROM mesa WHERE mes_numero = $mesa");
			$mes_id=$consulta2[0]->mes_id;

			$consulta=$link->insert_query("INSERT INTO venta( caj_id, cli_rut, ven_estado, mes_id, ven_total, ven_fecha,ven_mediopago)
    		VALUES ('$caja', '$user', 'PENDIENTE', '$mes_id', '$suma', '$fecha','$mediodepago')");

			$consulta2=$link->select_query("SELECT ven_id FROM venta ORDER BY ven_id DESC LIMIT 1");
			$ven_id = $consulta2[0]->ven_id;

			$EstadoPedido="INTERNET";
			$Hora=$hora=date("H:i:s");

			$consulta2=$link->insert_query("INSERT INTO pedido(ven_id,mes_id,ped_total,ped_estado,ped_hora) 
				VALUES('$ven_id','$mes_id','$suma','$EstadoPedido','$Hora')");
			
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
	}
?>