<?php
	App::uses("AdminController","Controller");
	
	class GastoController extends AdminController{
		
		public function index() {
			if(!$this->request->isPost())
			{
				$consulta=$this->Gasto->mostrar();
				$consulta2=$this->Gasto->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$consulta=$this->Gasto->mostrarporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Gasto->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
		}

		public function nuevo() {
			if($this->request->isPost())
			{
				$consulta=$this->Gasto->insertar($this->request->data);
				$consulta2=$this->Gasto->sucursales();
				$consulta3=$this->Gasto->ruts();
				$consulta4=$this->Gasto->cajas($_SESSION["usuario"]->suc_id);

				$this->set('Estado',$consulta);
				$this->set('Sucursal',$consulta2);
				$this->set('Rut',$consulta3);
				$this->set('Caja',$consulta4);

				if($consulta==true){
					$this->Session->setFlash("Gasto Ingresado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Gasto/');
				}
				else{
					$this->Session->setFlash("No se pudo Ingresar el Gasto.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Gasto/');
				}
			}
			else{
				$consulta=$this->Gasto->sucursales();
				$consulta3=$this->Gasto->ruts();
				$consulta4=$this->Gasto->cajas($_SESSION["usuario"]->suc_id);

				$this->set('Sucursal',$consulta);
				$this->set('Rut',$consulta3);
				$this->set('Caja',$consulta4);
			}
		}

		public function eliminar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Gasto->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Gasto Eliminado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Gasto/');
				}
				else{
					$this->Session->setFlash("No se pudo Eliminar el Gasto, revise que el Gasto no se encuentre en la BD.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Gasto/');
				}	
			}
		}
	}
?>