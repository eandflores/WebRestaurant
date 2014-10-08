<?php 

	App::uses("AdminController","Controller");

	class ReservaController extends AdminController{

		public function index(){
			if(!$this->request->isPost())
			{
				$reserva = $this->Reserva->readAll();
				$consulta2=$this->Reserva->sucursales();
				$this->set("emp",$reserva);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$reserva = $this->Reserva->readAllporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Reserva->sucursales();
				$this->set("emp",$reserva);
				$this->set('Sucursal',$consulta2);
			}
		}

		/*public function edit($id){
			$actual = $this->Personal->get($id);
			$roles = $this->Personal->getRoles();
			$this->set("actual", $actual[0]);
			$this->set("roles",$roles);
			if($this->request->isPost()){
				$ex = $this->Personal->actualizar($id,$this->request->data);
				if($ex)
					$this->Session->setFlash("Modificado Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Ups! cometimos un error intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				$this->redirect("/personal");
			}
		}*/

		public function view($id){
			$actual = $this->Reserva->get($id);
			$this->set("actual", $actual[0]);	
		}

		public function add(){
			$sucursales = $this->Reserva->getSucursales();
			//$roles = $this->Personal->getRoles();
			$this->set("sucursales", $sucursales);
			//$this->set("roles", $roles);
			if($this->request->isPost()){
				$r = $this->Reserva->guardar_Reserva($this->request->data);
				if($r){
					$this->Session->setFlash("Agregado, su confirmacion puede tardar algunos minutos...", 'default', array("class"=>"alert alert-success"));
				}else{
					$this->Session->setFlash("Ups! cometimos un error en la reserva", "default", array("class"=>"alert alert-error"));
				}
				$this->redirect("/personal");//direccionar???
			}
		}

		public function remuneraciones(){
			if($this->request->isPost()){
				$Fecha=$this->request->data['Fecha'];
				$Sucursal=$this->request->data['selectSucursal'];

				$sueldos=$this->Personal->get_sueldosporsucursal($Fecha,$Sucursal);
				$sucursales=$this->Personal->sucursales();
					
				$this->set('Fecha',$Fecha);
				$this->set('Sueldos',$sueldos);
				$this->set('Sucursal',$sucursales);
			}
			else{
				$Fecha=date('Y-m-d');
				$sueldos=$this->Personal->get_sueldos($Fecha);
				$sucursales=$this->Personal->sucursales();

				$this->set('Fecha',$Fecha);
				$this->set('Sueldos',$sueldos);
				$this->set('Sucursal',$sucursales);
			}
		}

		public function agregarremuneracion(){
			if(!$this->request->isPost())
			{
				$empleados=$this->Personal->readAll();
				$sucursales=$this->Personal->sucursales();

				$this->set("emp",$empleados);
				$this->set('Sucursal',$sucursales);
			}
			else{
				$empleados=$this->Personal->readAllporsucursal($this->request->data['selectSucursal']);
				$sucursales=$this->Personal->sucursales();

				$this->set('emp',$empleados);
				$this->set('Sucursal',$sucursales);
			}
			
		}

		public function agregarhoras(){
			if($this->request->isPost()){
				$Rut=$this->request->data['selectUser'];

				$empleado = $this->Personal->get($Rut);

				$this->set("emp",$empleado);
			}
		}	

		public function calcularremuneracion(){
			if($this->request->isPost()){
				$Datos=$this->request->data;

				$res = $this->Personal->addSueldo($Datos);

				if($res==true){
					$this->Session->setFlash("Remuneración Calculada Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Personal/agregarremuneracion/');
				}
				else{
					$this->Session->setFlash("No se pudo Calcular la Remuneración.",'default', array("class"=>"alert alert-error"));
					//$this->redirect('/Personal/agregarremuneracion/');
				}
			}
		}

		public function eliminar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Reserva->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Reserva Eliminada Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Reserva/');
				}
				else{
					$this->Session->setFlash("No se pudo Eliminar, intentelo nuevamente.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Reserva/');
				}	
			}
		}

		public function acep($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Reserva->acep($Id);

				if($consulta==true){
					$this->Session->setFlash("Reserva confirmada.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Reserva/');
				}
				else{
					$this->Session->setFlash("No se pudo confirmar reserva, intentelo nuevamente....",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Reserva/');
				}	
			}
		}

		public function getdias($id){
			$actual = date('Y-m-d');//obtener lista de dias para efectuar la reserva
			$this->set("actual", $actual[0]);	
		}						

	}


?>
