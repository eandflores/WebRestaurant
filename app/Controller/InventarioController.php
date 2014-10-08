<?php
	App::uses("AdminController","Controller");
	
	class InventarioController extends AdminController{
		
		public function index() {
			if(!$this->request->isPost())
			{
				$consulta=$this->Inventario->mostrar();
				$consulta2=$this->Inventario->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$consulta=$this->Inventario->mostrarporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Inventario->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
		}

		public function nuevo() {
			if($this->request->isPost())
			{
				$consulta=$this->Inventario->insertar($this->request->data);
				$consulta2=$this->Inventario->sucursales();

				$this->set('Sucursal',$consulta2);

				if($consulta==true){
					$this->Session->setFlash("Ingrediente Ingresado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Inventario/');
				}
				else{
					$this->Session->setFlash("No se pudo Ingresar el Ingrediente, revise que el ingrediente no se encuentre en la BD.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Inventario/');
				}
			}
			else{
				$consulta=$this->Inventario->sucursales();

				$this->set('Sucursal',$consulta);
			}
		}

		public function modificar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Inventario->buscar($Id);

				$this->set('Elemento',$consulta);
			}
			else{
				$consulta=$this->Inventario->modificar($this->request->data,$Id);

				$this->set('Elemento',null);

				if($consulta==true)
					$this->Session->setFlash("Ingrediente Actualizado Correctamente.",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("No se pudo Actualizar el Ingrediente.",'default', array("class"=>"alert alert-error"));
				
				$this->redirect('/Inventario/');
			}
		}

		public function modificar2($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Inventario->buscar($Id);

				$this->set('Elemento',$consulta);
			}
			else{
				$consulta=$this->Inventario->modificar2($this->request->data,$Id);

				$this->set('Elemento',null);

				if($consulta==true)
					$this->Session->setFlash("Ingrediente Actualizado Correctamente.",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("No se pudo Actualizar el Ingrediente.",'default', array("class"=>"alert alert-error"));
				
				$this->redirect('/Inventario/');
			}
		}

		public function eliminar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Inventario->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Ingrediente Eliminado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Inventario/');
				}
				else{
					$this->Session->setFlash("No se pudo Eliminar el Ingrediente, revise que no este siendo Utilizado.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Inventario/');
				}	
			}
		}
	}
?>