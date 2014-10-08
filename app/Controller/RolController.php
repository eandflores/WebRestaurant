<?php 

	App::uses("AdminController","Controller");

	class RolController extends AdminController{

		public function index(){
			$consulta=$this->Rol->mostrarRol();
			$this->set('rol',$consulta);
		}	

		public function add(){
			if($this->request->isPost()){
				$consulta=$this->Rol->insertar($this->request->data);
				if($consulta)
						$this->Session->setFlash("Rol ingresado Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Ups! cometimos un error intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				$this->redirect("/Rol");
			}
		}

		public function delete($Id) {
			if(!$this->request->isPost()){
				$consulta=$this->Rol->eliminar($Id);
					
				if($consulta)
						$this->Session->setFlash("Rol eliminada Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Imposible de eliminar ya que el Rol ya esta en funcionamiento",'default', array("class"=>"alert alert-error"));
				$this->redirect("/Rol");

			}
		}

		public function edit($id){
			$Rol = $this->Rol->verRol($id);
			$this->set("rol", $Rol[0]);
			if($this->request->isPost()){
				$ex = $this->Rol->actualizar($id,$this->request->data);
				if($ex)
					$this->Session->setFlash("Rol modificado Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Ups! cometimos un error intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				//$this->redirect("/rol");
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
