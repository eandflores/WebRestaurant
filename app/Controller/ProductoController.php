<?php 

	App::uses("AdminController","Controller");

	class ProductoController extends AdminController{

		public function index(){
			if(!$this->request->isPost())
			{
				$consulta=$this->Producto->mostrarProd();
				$consulta2=$this->Producto->sucursales();

				$this->set('prod',$consulta);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$consulta=$this->Producto->mostrarporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Producto->sucursales();

				$this->set('prod',$consulta);
				$this->set('Sucursal',$consulta2);
			}
		}	

		public function add(){
			$consulta=$this->Producto->mostrarIng();
			$this->set('ing',$consulta);
			
			$consulta2=$this->Producto->sucursales();
			$this->set('Sucursal',$consulta2);

			if($this->request->isPost()){
				$consulta=$this->Producto->registrarProducto($this->request->data);
				$this->set('Estadootro',$consulta);
				if($consulta==true)
						$this->Session->setFlash("Producto ingresado Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("El nombre del producto ya se encuentra registrado",'default', array("class"=>"alert alert-error"));
				$this->redirect("/producto");
				
			}
		}

		public function view($id){
			$actual = $this->Producto->verProducto($id);
			$this->set("actual", $actual[0]);

			$ingredientes = $this->Producto->verIngrediente($id);
			$this->set("actual_2",$ingredientes);	
		}

		public function delete($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Producto->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Producto Deshabilitado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Producto/');
				}
				else{
					$this->Session->setFlash("No se pudo Deshabilitar el Producto.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Producto/');
				}	
			}
		}

		public function enable($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Producto->enable($Id);

				if($consulta==true){
					$this->Session->setFlash("Producto Habilitado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Producto/');
				}
				else{
					$this->Session->setFlash("No se pudo Habilitar el Producto.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Producto/');
				}	
			}
		}

		public function edit($id){
			$producto = $this->Producto->verProducto($id);
			$ingrediente = $this->Producto->verIngrediente($id);
			$consulta=$this->Producto->mostrarIng();
			
			$this->set('ing',$consulta);
			$this->set("producto", $producto[0]);
			$this->set("ingrediente",$ingrediente);

			if($this->request->isPost()){
				$ex = $this->Producto->actualizar($id,$this->request->data);
				if($ex)
					$this->Session->setFlash("Modificado Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("Ups! cometimos un error intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				$this->redirect("/producto");
			}
		}
	}
?>
