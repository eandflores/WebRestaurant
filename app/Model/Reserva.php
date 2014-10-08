<?php
	App::uses("BaseDatos", "Vendor");

	class Reserva extends AppModel{

		public function readAll(){
			$Fecha=date('Y-m-d');

			$link = new BaseDatos();
			$sql = "SELECT * FROM reserva r, mesa m, cliente c where r.mes_id=m.mes_id and r.cli_rut=c.cli_rut  and r.res_fecha >= current_date order by r.res_estado, r.res_fecha asc";
			$response = $link->select_query($sql);
			$tmp = array();
			if(is_null($response)){
				return array();
			}
			return $response;
		}

		public function readAllporsucursal($Sucursal){
			$Fecha=date('Y-m-d');
			$link = new BaseDatos();
			$sql = "SELECT * FROM reserva r, mesa m WHERE r.mes_id=m.mes_id and m.suc_id='$Sucursal' order by r.res_estado,r.res_fecha asc";
			$response = $link->select_query($sql);
			$tmp = array();
			if(is_null($response)){
				return array();
			}
			return $response;
		}

		public function get($id){
			$link = new BaseDatos();
			$sql = "SELECT * FROM reserva r, mesa m, cliente c, sucursal s where r.mes_id=m.mes_id and r.cli_rut=c.cli_rut and s.suc_id=m.suc_id and r.res_id='$id' order by r.res_fecha desc";
			//$sql = "SELECT rol_nombre,rol_sueldo_base FROM rol WHERE rol_id =".$res[0]->rol_id;
			$r = $link->select_query($sql);
			return $r;
		}

		

		public function getSucursales(){
			$link = new BaseDatos();
			return $link->select_query("SELECT * FROM sucursal");
		}

		//no ocupada
		public function actualizar($rut,$data){
			$link = new BaseDatos();
			$sql = "UPDATE trabajador SET tra_rut ='{rut}', tra_nombre='{nombre}', tra_apellido='{apellido}', rol_id={rol} WHERE usu_rut='$rut'";
			$sql = str_replace("{rut}", $data["rut"], $sql);
			$sql = str_replace("{nombre}", $data["nombre"], $sql);
			$sql = str_replace("{apellido}", $data["apellido"], $sql);
			$sql = str_replace("{rol}", $data["rol_id"], $sql);
			$response = $link->insert_query($sql);
			return $response;
		}

		public function guardar_Reserva($datos){
			$link = new BaseDatos();
			$sql = "INSERT INTO trabajador(tra_rut, tra_nombre, tra_apellido, tra_password, rol_id, suc_id)
					VALUES('{rut}','{nombre}','{apellido}','{password}',{rol},{suc})";
			$sql = str_replace("{rut}", $datos["rut"], $sql);
			$sql = str_replace("{nombre}", $datos["nombre"], $sql);
			$sql =	str_replace("{apellido}", $datos["apellidos"], $sql);
			$sql = str_replace("{password}", md5($datos["clave"]), $sql);
			$sql = str_replace("{rol}", $datos["rol_id"], $sql);
			$sql = str_replace("{suc}", $datos["suc_id"], $sql);
			return $link->insert_query($sql);
		}


		/*public function addSueldo($form){
			$Rut=$form['Rut'];
			$Horas=$form['Horas'];
			$SueldoRol=$form['Sueldo'];
			$Fecha=date('Y-m-d');
			$Monto=$Horas*$SueldoRol;

			$link = new BaseDatos();
			$consulta=$link->insert_query("INSERT INTO sueldo(tra_rut,sue_monto,sue_fecha_pago,sue_horas_trab) 
				VALUES('$Rut','$Monto','$Fecha','$Horas')");
			
			return $consulta;
		}*/

		/*public function get_sueldos($fecha){
			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT T.tra_rut, T.tra_nombre, T.tra_apellido, 
												T.suc_id,S.sue_horas_trab,R.rol_sueldo_base,S.sue_fecha_pago 
											FROM Trabajador T, Sueldo S, Rol R
											WHERE T.rol_id=R.rol_id AND T.tra_rut=S.tra_rut AND S.sue_fecha_pago='$fecha'");

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
		}*/

		public function get_reservaporsucursal($fecha,$sucursal){//modificar
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT mes_id,mes_numero 
											FROM mesa
											WHERE mes_estado=true
											-
											SELECT mes_id,mes_numero 
											FROM mesa m, reserva r
											WHERE  r.mes_id=m.mes_id and r.res_estado is not null
													and r.res_fecha='$fecha' and m.suc_id='$sucursal'");

			$tmp = array();

			if(is_null($consulta)){
				return array();
			}
			/*foreach ($consulta as $key => $value) {
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$tmp[] = $value;
			}*/
			
			return $tmp;
		}

		public function sucursales(){ 
			$link = new BaseDatos();
			$consulta=$link->select_query("SELECT suc_id,suc_nombre FROM sucursal ORDER BY suc_nombre");
			return $consulta;
		}

		public function getMesas($Id){
			$link = new BaseDatos();
			return $link->select_query("SELECT * FROM mesa where suc_id='$Id' ");
		}


		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("DELETE FROM reserva WHERE res_id='$Id'");
			return $consulta;
		}

		public function acep($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("UPDATE reserva set res_estado='true' WHERE res_id='$Id'");
			return $consulta;
		}
	}
?>