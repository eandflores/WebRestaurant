<?php 

	App::uses("AdminController","Controller");

	class CajaController extends AdminController{
		public function index() {
			if(!$this->request->isPost())
			{
				$consulta=$this->Caja->MostrarCajas();
				$consulta2=$this->Caja->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$consulta=$this->Caja->mostrarporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Caja->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
		}


		public function add(){
			$sucursales = $this->Caja->getSucursales();
			$this->set("sucursales", $sucursales);
			if($this->request->isPost()){
				$r = $this->Caja->AgregarCaja($this->request->data);
				if($r){
					$this->Session->setFlash("Agregado Exitosamente", 'default', array("class"=>"alert alert-success"));
				}else{
					$this->Session->setFlash("Ups! cometimos un error guardando al nuevo usuario", "default", array("class"=>"alert alert-error"));
				}
				$this->redirect("/Caja");
			}
		}

		public function eliminar($Id){
			if(!$this->request->isPost()){
				$consulta=$this->Caja->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Caja eliminada correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Caja/');
				}
				else{
					$this->Session->setFlash("No se pudo eliminar la caja, revise que no este siendo utilizada.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Caja/');
				}	
			}
		}
	}

?>