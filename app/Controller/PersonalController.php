<?php 

	App::uses("AdminController","Controller");

	class PersonalController extends AdminController{

		public function index(){
			if(!$this->request->isPost())
			{
				$empleados = $this->Personal->readAll();
				$consulta2=$this->Personal->sucursales();

				$this->set("emp",$empleados);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$empleados = $this->Personal->readAllporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Personal->sucursales();

				$this->set("emp",$empleados);
				$this->set('Sucursal',$consulta2);
			}
		}

		public function edit($id){
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
		}

		public function view($id){
			$actual = $this->Personal->readAll($id);
			$this->set("actual", $actual[0]);	
		}

		public function add(){
			$sucursales = $this->Personal->getSucursales();
			$roles = $this->Personal->getRoles();
			$this->set("sucursales", $sucursales);
			$this->set("roles", $roles);

			if($this->request->isPost()){
				$r = $this->Personal->guardar_usuario($this->request->data);
				
				if($r==true){
					$this->Session->setFlash("Usuario agregado exitosamente", 'default', array("class"=>"alert alert-success"));
				}else{
					$this->Session->setFlash("No se pudo guardar el usuario, revise que el usuario no se encuentre en la base de datos", "default", array("class"=>"alert alert-error"));
				}
				
				$this->redirect("/personal");
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
				$consulta=$this->Personal->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Usuario Deshabilitado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Personal/');
				}
				else{
					$this->Session->setFlash("No se pudo Eliminar el Usuario, revise que no este siendo Utilizado.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Personal/');
				}	
			}
		}
		public function enable($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Personal->enable($Id);

				if($consulta==true){
					$this->Session->setFlash("Usuario Habilitado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Personal/');
				}
				else{
					$this->Session->setFlash("No se pudo Habilitar el Usuario.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Personal/');
				}	
			}
		}		

	}


?>
