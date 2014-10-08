<?php 

	App::uses("AdminController","Controller");

	class ClienteController extends AdminController{

		/*public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow(array('add'));
		}*/
		

		public function index(){
				$clientes = $this->Cliente->readAll();
				$this->set("emp",$clientes); //ojo con emp
		}

		public function edit($id){
			$actual = $this->Cliente->get($id);
			$this->set("actual", $actual[0]);
			if($this->request->isPost()){
				$ex = $this->Cliente->actualizar($id,$this->request->data);
				if($ex)
					$this->Session->setFlash("Modificado Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Ups! cometimos un error, intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				$this->redirect("/Cliente");
			}
		}

		public function view($id){
			$actual = $this->Cliente->get($id);
			$this->set("actual", $actual[0]);	
		}

		public function add(){
			if($this->request->isPost()){
				//print_r($this->request);
				$r = $this->Cliente->guardar_cliente($this->request->data);
				if($r){
					$this->Session->setFlash("Agregado Exitosamente", 'default', array("class"=>"alert alert-success"));
				}else{
					$this->Session->setFlash("Ups! cometimos un error guardando al nuevo usuario", "default", array("class"=>"alert alert-error"));
				}
				$this->redirect("/Cliente");
			}
		}

		public function eliminar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Cliente->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Usuario Eliminado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Cliente/');
				}
				else{
					$this->Session->setFlash("No se pudo Eliminar el Usuario, revise que no este siendo Utilizado.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Cliente/');
				}	
			}
		}

		

	}


?>
