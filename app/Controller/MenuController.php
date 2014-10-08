<?php
	App::uses("AdminController","Controller");
	
	class MenuController extends AdminController{

		public function index() {
			if(!$this->request->isPost())
			{
				$consulta=$this->Menu->mostrar();
				$consulta2=$this->Menu->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$consulta=$this->Menu->mostrarporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Menu->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
		}

		public function nuevo(){
			$consulta=$this->Menu->productos();
			$this->set('Producto',$consulta);
			
			$consulta2=$this->Menu->sucursales();
			$this->set('Sucursal',$consulta2);

			if($this->request->isPost()){
				$consulta=$this->Menu->insertar($this->request->data);
				$this->set('Estadootro',$consulta);
				
				if($consulta==true)
					$this->Session->setFlash("Menu Ingresado Exitosamente.",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("No se pudo Ingresar el Menu, revise que el Menu no se encuentre en la BD.",'default', array("class"=>"alert alert-error"));
				
				$this->redirect("/Menu");
				
			}
		}

		public function ver($Id){
			$consulta=$this->Menu->buscar($Id);
			$consulta2=$this->Menu->buscarProductos($Id);
			$consulta3=$this->Menu->productos();

			$this->set('Elemento',$consulta);
			$this->set('Productos',$consulta2);
			$this->set('ProductosDis',$consulta3);
		}

		public function modificar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Menu->buscar($Id);
				$consulta2=$this->Menu->buscarProductos($Id);
				$consulta3=$this->Menu->productos();

				$this->set('Elemento',$consulta);
				$this->set('Productos',$consulta2);
				$this->set('ProductosDis',$consulta3);
			}
			else{
				$consulta=$this->Menu->modificar($Id,$this->request->data);

				$this->set('Elemento',null);
				$this->set('Productos',null);
				$this->set('ProductosDis',null);

				if($consulta==true){
					$this->Session->setFlash("Menu Actualizado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Menu/');
				}
				else{
					$this->Session->setFlash("No se pudo Actualizar el Menu.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Menu/');
				}
			}
		}

		public function eliminar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Menu->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Menu Deshabilitado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Menu/');
				}
				else{
					$this->Session->setFlash("No se pudo Deshabilitar el Menu.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Menu/');
				}	
			}
		}

		public function enable($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Menu->enable($Id);

				if($consulta==true){
					$this->Session->setFlash("Menu Habilitado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Menu/');
				}
				else{
					$this->Session->setFlash("No se pudo Habilitar el Menu.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Menu/');
				}	
			}
		}
	}
?>