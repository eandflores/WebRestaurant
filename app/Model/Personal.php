<?php
	App::uses("BaseDatos", "Vendor");

	class Personal extends AppModel{

		public function readAll(){
			$Fecha=date('Y-m-d');

			$link = new BaseDatos();
			$sql = "SELECT * FROM trabajador";
			$response = $link->select_query($sql);
			$tmp = array();
			if(is_null($response)){
				return array();
			}
			foreach ($response as $key => $value) {
				$sql = "SELECT rol_nombre FROM rol WHERE rol_id =".$value->rol_id;
				$r = $link->select_query($sql);
				$value->rol_nombre = $r[0]->rol_nombre;
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$sql = "SELECT sue_id FROM sueldo WHERE sue_fecha_pago='$Fecha' AND tra_rut='$value->tra_rut'";
				$r = $link->select_query($sql);
				$value->sue_estado = $r;
				$tmp[] = $value;
			}
			return $tmp;
		}

		public function readAllporsucursal($Sucursal){
			$Fecha=date('Y-m-d');
			$link = new BaseDatos();
			$sql = "SELECT * FROM trabajador WHERE suc_id='$Sucursal'";
			$response = $link->select_query($sql);
			$tmp = array();
			if(is_null($response)){
				return array();
			}
			foreach ($response as $key => $value) {
				$sql = "SELECT rol_nombre FROM rol WHERE rol_id =".$value->rol_id;
				$r = $link->select_query($sql);
				$value->rol_nombre = $r[0]->rol_nombre;
				$sql = "SELECT suc_nombre FROM sucursal WHERE suc_id =".$value->suc_id;
				$r = $link->select_query($sql);
				$value->suc_nombre = $r[0]->suc_nombre;
				$sql = "SELECT sue_id FROM sueldo WHERE sue_fecha_pago='$Fecha' AND tra_rut='$value->tra_rut'";
				$r = $link->select_query($sql);
				$value->sue_estado = $r;
				
				$tmp[] = $value;
			}
			return $tmp;
		}

		public function get($id){
			$link = new BaseDatos();
			$res = $link->select_query("SELECT * from trabajador WHERE tra_rut='$id';");
			$sql = "SELECT rol_nombre,rol_sueldo_base FROM rol WHERE rol_id =".$res[0]->rol_id;
			$r = $link->select_query($sql);
			$res[0]->rol_nombre = $r[0]->rol_nombre;
			$res[0]->rol_sueldo_base = $r[0]->rol_sueldo_base;
			return $res;
		}

		public function getRoles(){
			$link = new BaseDatos();
			return $link->select_query("SELECT * FROM rol");
		}

		public function getSucursales(){
			$link = new BaseDatos();
			return $link->select_query("SELECT * FROM sucursal");
		}

		public function actualizar($rut,$data){
			$link = new BaseDatos();
			$sql = "UPDATE trabajador SET tra_rut ='{rut}', tra_nombre='{nombre}', tra_apellido='{apellido}', tra_telefono='{telefono}', tra_direccion='{direccion}', tra_correo='{correo}', rol_id={rol} WHERE tra_rut='$rut'";
			$sql = str_replace("{rut}", $data["rut"], $sql);
			$sql = str_replace("{nombre}", $data["nombre"], $sql);
			$sql = str_replace("{apellido}", $data["apellido"], $sql);
			$sql = str_replace("{telefono}", $data["telefono"], $sql);
			$sql = str_replace("{direccion}", $data["direccion"], $sql);
			$sql = str_replace("{correo}", $data["correo"], $sql);
			$sql = str_replace("{rol}", $data["rol_id"], $sql);
			$response = $link->insert_query($sql);
			return $response;
		}

		public function guardar_usuario($datos){
			$link = new BaseDatos();
			$Rut = $datos['rut'];

			$consulta=$link->select_query("SELECT * FROM trabajador WHERE tra_rut='$Rut'");

			if($consulta == null){
				$sql = "INSERT INTO trabajador(tra_rut, tra_nombre, tra_apellido, tra_password, tra_telefono, tra_direccion, tra_correo, tra_estado, rol_id, suc_id)
					VALUES('{rut}','{nombre}','{apellido}','{password}','{telefono}','{direccion}','{correo}','{estado}','{rol}','{suc}')";
				
				$sql = str_replace("{rut}", $datos["rut"], $sql);
				$sql = str_replace("{nombre}", $datos["nombre"], $sql);
				$sql =	str_replace("{apellido}", $datos["apellidos"], $sql);
				$sql = str_replace("{password}", md5($datos["clave"]), $sql);
				$sql = str_replace("{telefono}", $datos["telefono"], $sql);
				$sql = str_replace("{direccion}", $datos["direccion"], $sql);
				$sql = str_replace("{correo}", $datos["correo"], $sql);
				$sql = str_replace("{estado}", true, $sql);
				$sql = str_replace("{rol}", $datos["rol_id"], $sql);
				$sql = str_replace("{suc}", $datos["suc_id"], $sql);
				$link->insert_query($sql);
			}
			else{
				$sql = false;
			}

			return $sql;
		}


		public function addSueldo($form){
			$Rut=$form['Rut'];
			$Horas=$form['Horas'];
			$SueldoRol=$form['Sueldo'];
			$Fecha=date('Y-m-d');
			$Monto=$Horas*$SueldoRol;

			$link = new BaseDatos();
			$consulta=$link->insert_query("INSERT INTO sueldo(tra_rut,sue_monto,sue_fecha_pago,sue_horas_trab) 
				VALUES('$Rut','$Monto','$Fecha','$Horas')");
			
			return $consulta;
		}

		public function get_sueldos($fecha){
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
		}

		public function get_sueldosporsucursal($fecha,$sucursal){
			$link = new BaseDatos();

			$consulta=$link->select_query("SELECT T.tra_rut, T.tra_nombre, T.tra_apellido, 
												T.suc_id,S.sue_horas_trab,R.rol_sueldo_base,S.sue_fecha_pago
											FROM Trabajador T, Sueldo S, Rol R
											WHERE T.rol_id=R.rol_id AND T.tra_rut=S.tra_rut AND S.sue_fecha_pago='$fecha' AND T.suc_id='$sucursal'");

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

		public function eliminar($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("UPDATE trabajador SET tra_estado=false WHERE tra_rut='$Id'");

			return $consulta;
		}

		public function enable($Id){
			$link = new BaseDatos();
			$consulta=$link->insert_query("UPDATE trabajador SET tra_estado=true WHERE tra_rut='$Id'");

			return $consulta;
		}
	}


?>