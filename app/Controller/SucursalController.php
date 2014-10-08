<?php 

	App::uses("AdminController","Controller");

	class SucursalController extends AdminController{

		public function index(){
			$consulta=$this->Sucursal->mostrarSuc();
			$this->set('suc',$consulta);
		}	

		public function add(){
			if($this->request->isPost()){
				$consulta=$this->Sucursal->registrarSuc($this->request->data);
				$this->set('Estado',$consulta);
				if($consulta)
						$this->Session->setFlash("Sucursal ingresada Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Ups! cometimos un error intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				$this->redirect("/sucursal");
				
			}
		}

		public function view($id){
			$actual = $this->Sucursal->verSucursal($id);
			$this->set("actual", $actual[0]);
	
		}

		public function edit($id){
			$sucursal = $this->Sucursal->verSucursal($id);
			$this->set("sucursal", $sucursal[0]);
			if($this->request->isPost()){
				$ex = $this->Sucursal->actualizar($id,$this->request->data);
				if($ex)
					$this->Session->setFlash("Modificado Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Ups! cometimos un error intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				$this->redirect("/sucursal");
			}
		}

		public function isAuthorized(){
			$usu = $_SESSION["usuario"];
			if(strtoupper($usu->rol_nombre) == "ADMINISTRADOR")
				return true;
			else
				return false;
		}

	}
?>
