<?php 

	App::uses("AdminController","Controller");

	class MesaController extends AdminController{
		public function index(){
			if(!$this->request->isPost())
			{
				$consulta=$this->Mesa->MostrarMesas();
				$consulta2=$this->Mesa->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$consulta=$this->Mesa->mostrarporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Mesa->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
		}
	
		public function add(){
			$sucursales = $this->Mesa->getSucursales();
			$this->set("sucursales", $sucursales);
			if($this->request->isPost()){
				$r = $this->Mesa->AgregarMesa($this->request->data);
				if($r){
					$this->Session->setFlash("Agregado Exitosamente.", 'default', array("class"=>"alert alert-success"));
				}else{
					$this->Session->setFlash("No se pudo guardar la mesa, revise que no exista una mesa con el mismo número.", "default", array("class"=>"alert alert-error"));
				}
				$this->redirect("/Mesa");
			}
		}

		public function view($id){
			$actual = $this->Mesa->verMesas($id);
			$this->set("actual", $actual[0]);
	
		}

		public function isAuthorized(){
			$usu = $_SESSION["usuario"];
			if(strtoupper($usu->rol_nombre) == "ADMINISTRADOR")
				return true;
			else
				return false;
		}

		public function eliminar($Id){
			if(!$this->request->isPost()){
				$consulta=$this->Mesa->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Mesa eliminada correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Mesa/');
				}
				else{
					$this->Session->setFlash("No se pudo eliminar la mesa",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Mesa/');
				}	
			}
		}
	}
?>