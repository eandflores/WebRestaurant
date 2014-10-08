<?php
	class DeusuarioController extends AppController{

		public function beforeFilter(){
	     	$this->layout = 'default';
		}

		public function cuantopido(){
			if(!isset($_SESSION["usuario"]))
				$this->redirect(array('action' => 'index'));
		}

		public function cuantopido2(){
			if(!isset($_SESSION["usuario"]))
				$this->redirect(array('action' => 'index'));
		}

		public function comprar(){
			if(isset($_SESSION["usuario"])){ 
				$consulta=$this->Deusuario->mostrarSucursal();
				$this->set('Datos_sucursal',$consulta);
			}
			else
				$this->redirect(array('action' => 'index'));
		}

		public function pedidos() {
			if(isset($_SESSION["usuario"])){ 
				$consulta=$this->Deusuario->mostrarProductos($this->request->data);
				$this->set('Datos_productos',$consulta);

				$consulta=$this->Deusuario->mostrarPromociones($this->request->data);
				$this->set('Datos_promocion',$consulta);

				$this->set('medio_pago',$this->request->data['mediodepago']);
				$this->set('_sucursal',$this->request->data['sucursal']);
			}
			else
				$this->redirect(array('action' => 'index'));
		}

		public function pedidos2() {
			if(isset($_SESSION["usuario"])){ 
				if($this->request->isPost()){
					$consulta=$this->Deusuario->comprar($this->request->data);
					
					if($consulta)
						$this->Session->setFlash("Compra realizada exitosamente.",'default', array("class"=>"alert alert-success"));
					else
						$this->Session->setFlash("No se pudo realizar la compra, intentalo nuevamente.",'default', array("class"=>"alert alert-error"));	
				}
			}
			$this->redirect(array('action' => 'index'));
		}

		public function addres($mesa,$fecha,$hora,$rut) {
			if(!isset($_SESSION["usuario"]))
				$this->redirect(array('action' => 'index'));

			if(!$this->request->isPost())
			{
				$consulta=$this->Deusuario->addres($mesa,$fecha,$hora,$rut);

				if($consulta == true){
					$this->Session->setFlash("Reserva realizada, espere confirmacion.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Deusuario/reservar/');
				}
				else{
					$this->Session->setFlash("No se pudo confirmar reserva, intentelo nuevamente.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Deusuario/reservar/');
				}	
			}
		}


		public function deleteres($Id) {
			if(!isset($_SESSION["usuario"]))
				$this->redirect(array('action' => 'index'));
			
			$consulta=$this->Deusuario->deleteres($Id);

			if($consulta==true){
				$this->Session->setFlash("Reserva Eliminada Correctamente.",'default', array("class"=>"alert alert-success"));
				$this->redirect('/Deusuario/reservar/');
			}
			else{
				$this->Session->setFlash("No se pudo Eliminar, debe hacerlo con 24 horas de anticipacion.",'default', array("class"=>"alert alert-error"));
				$this->redirect('/Deusuario/reservar/');
			}	
		}

		
		public function reservar(){ 
			if(!isset($_SESSION["usuario"]))
				$this->redirect(array('action' => 'index'));

			if(!$this->request->isPost()){
				$sucursal=$this->Deusuario->mostrarSucursal();
				$usu = $_SESSION["usuario"]; //quiero enviar rut!
				$mis = $this->Deusuario->mireserva($usu);// estara bien???

				$this->set("metodo","GET");
				$this->set("mis",$mis);
				$this->set('sucursal',$sucursal);
			}
			
			if($this->request->isPost()){
				$sucursal=$this->Deusuario->mostrarSucursal();
				$usu = $_SESSION["usuario"]; //quiero enviar rut!
				$mis = $this->Deusuario->mireserva($usu);

				$this->set("metodo","POST");
				$this->set("mis",$mis);
				$this->set('sucursal',$sucursal);

				$emp = $this->Deusuario->reservar($this->request->data);

				if(is_null($emp)){
					$this->Session->setFlash("No hay mesas disponibles en este horario.",'default', array("class"=>"alert alert-error"));
				}

				$this->set("emp",$emp);
			}
		}

		public function registrarme() {
			if($this->request->isPost()){
				$consulta=$this->Deusuario->registrarCliente($this->request->data);
				$this->set('Estado',$consulta);
			}
		}

		public function index(){
			
		}
	}
?>