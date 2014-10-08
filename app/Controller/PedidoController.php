<?php
	App::uses("VendedorController","Controller");
	
	class PedidoController extends VendedorController{
		
		public function colapedido(){
			$usu= $_SESSION['usuario'];
			$su= $usu->suc_id;
			$ped=$this->Pedido->estado2($su);
			$this->set("emp", $ped);
		}

		public function index() {
			if(!$this->request->isPost())
			{
				$consulta=$this->Pedido->mostrar();
				$consulta2=$this->Pedido->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
			else{
				$consulta=$this->Pedido->mostrarporsucursal($this->request->data['selectSucursal']);
				$consulta2=$this->Pedido->sucursales();

				$this->set('Datos',$consulta);
				$this->set('Sucursal',$consulta2);
			}
		}

		public function cancelar($Id) {
			//Missing argument 1 for PedidoController::cancelar()
			// [APP\Controller\PedidoController.php, line 24]
			//falta argumento???? :S
			$usu= $_SESSION['usuario'];
			$su= $usu->suc_id;
			$ped=$this->Pedido->estado2($su);
			$this->set("emp", $ped);

			if($this->request->isPost()){
				echo $Id;
				$consulta=$this->Pedido->eliminarpedido($Id);

				if($consulta==true){
					$this->Session->setFlash("Pedido Eliminado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Pedido/colapedido/');
				}
				else{
					$this->Session->setFlash("UPS! No se pudo Eliminar el Pedido, intentelo nuevamente.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Pedido/colapedido/');
				}	
			}
			
		}

		public function nuevo() {
			if($this->request->isPost())
			{
				$consulta=$this->Pedido->insertar($this->request->data);
				$consulta2=$this->Pedido->sucursales();
				$consulta3=$this->Pedido->ruts();
				$consulta4=$this->Pedido->cajas($_SESSION["usuario"]->suc_id);

				$this->set('Estado',$consulta);
				$this->set('Sucursal',$consulta2);
				$this->set('Rut',$consulta3);
				$this->set('Caja',$consulta4);

				if($consulta==true){
					$this->Session->setFlash("Pedido Ingresado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Pedido/');
				}
				else{
					$this->Session->setFlash("No se pudo Ingresar el Pedido.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Pedido/');
				}
			}
			else{
				$consulta=$this->Pedido->sucursales();
				$consulta3=$this->Pedido->ruts();
				$consulta4=$this->Pedido->cajas($_SESSION["usuario"]->suc_id);

				$this->set('Sucursal',$consulta);
				$this->set('Rut',$consulta3);
				$this->set('Caja',$consulta4);
			}
		}

		public function eliminar($Id) {
			if(!$this->request->isPost())
			{
				$consulta=$this->Pedido->eliminar($Id);

				if($consulta==true){
					$this->Session->setFlash("Pedido Eliminado Correctamente.",'default', array("class"=>"alert alert-success"));
					$this->redirect('/Pedido/');
				}
				else{
					$this->Session->setFlash("No se pudo Eliminar el Pedido, revise que el Gasto no se encuentre en la BD.",'default', array("class"=>"alert alert-error"));
					$this->redirect('/Pedido/');
				}	
			}
		}

		public function entregado(){
			$usu= $_SESSION['usuario'];
			$su= $usu->suc_id;
			//echo $su;

			if(!$this->request->isPost()){
				$mesas = $this->Pedido->getMP($su);
				$this->set("actual", $mesas);
			}

			if($this->request->isPost()){
				$ped=$this->Pedido->estado($this->request->data);
				
				if($ped){
					//actualizar pedido de productos
					$consulta=$this->Pedido->aceptada($this->request->data);
					$c=0;

					if($consulta){
						foreach ($consulta as $key => $value) {
							//enviar ing_id, con_cantidad
							$r=$this->Pedido->descontar($value->ing_id,$value->con_cantidad,1);
							
							if($r)
								$c=$c+1;
						}
							
					}
					//	$this->Session->setFlash("OK, ingredientes descontados",'default', array("class"=>"alert alert-success"));
					//else $this->Session->setFlash("Ups! cometimos un error intentalo nuevamente",'default', array("class"=>"alert alert-error"));
					

					//actualizar pedido de menus
					$consulta2=$this->Pedido->aceptamenu($this->request->data);
					
					if($consulta2 ){
						foreach ($consulta2 as $key => $value) {
							//enviar ing_id, con_cantidad
							$r=$this->Pedido->descontar($value->ing_id,$value->con_cantidad,$value->pos_cantidad);
							
							if($r)
								$c=$c+1;
						}
					}

					if($c==0) 
						$this->Session->setFlash("Ups! creo que no se ha descontado",'default', array("class"=>"alert alert-error"));
						
					$this->Session->setFlash("OK, $c ingredientes descontados",'default', array("class"=>"alert alert-success"));
					$mesas = $this->Pedido->getMP($su);
					$this->set("actual", $mesas);

				}
				else {
					$this->Session->setFlash("OK,pedido ya descontados",'default', array("class"=>"alert alert-success"));
					$mesas = $this->Pedido->getMP($su);
					$this->set("actual", $mesas);
				}
			}
		}

		/*
		public function agregarcola(){
			if($this->request->isPost()){
				$req = $this->request;
				$datos = $req->data;
				//$datos["caj_id"] = $this->Session->read("caja")[1];
				$tmp = $this->Pedido->generar_pedido($datos);
				
				if($tmp=true){
					$this->Session->setFlash("Pedido Registrado Exitosmanete", "default",array("class"=>"alert alert-success"));
				}else{
					$this->Session->setFlash("UPS! No se realizo el pedido, comunica con el administrador", "default",array("class"=>"alert alert-error"));
				}
			}
			else{
				$producto = $this->Pedido->getProductos();
				$this->set("productos", $producto);

				$menu = $this->Pedido->getPromociones();
				$this->set("promos", $menu);

				$mesas = $this->Pedido->getM();
				$this->set("actual", $mesas);
			}
		}*/

		public function add2(){
			
			if($this->request->isPost()){
				$consulta=$this->Pedido->pedir($this->request->data);
				if($consulta)
					$this->Session->setFlash("PEDIDO Ingresada Exitosamente",'default', array("class"=>"alert alert-success"));
				else{
					$this->Session->setFlash("No se pudo Ingresar el PEDIDO, Intentalo nuevamente",'default', array("class"=>"alert alert-error"));
				}
				$mesas = $this->Pedido->getM();
				$this->set("actual", $mesas);

				$consulta=$this->Pedido->mostrarProductos($this->request->data);
				$this->set('Datos_productos',$consulta);

				$consulta=$this->Pedido->mostrarPromociones($this->request->data);
				$this->set('Datos_promocion',$consulta);
			}
			else{
			$mesas = $this->Pedido->getM();
			$this->set("actual", $mesas);

			$consulta=$this->Pedido->mostrarProductos($this->request->data);
			$this->set('Datos_productos',$consulta);

			$consulta=$this->Pedido->mostrarPromociones($this->request->data);
			$this->set('Datos_promocion',$consulta);
			//$this->set('_mesa',$this->request->data['mesa']);
			}
		}
	}
?>