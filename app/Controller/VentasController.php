<?php 
	App::uses("VendedorController","Controller");

	class VentasController extends VendedorController{

		public function index(){
			$consulta = $this->Venta->chequear();

			if($consulta==null){
				$this->set("caja",false);
			}else{
				$this->set("caja", true);
				$productos = $this->Venta->getProductos();
				$promos = $this->Venta->getPromociones();
				$this->set("productos", $productos);
				$this->set("promos",$promos);
			}
		}

		public function abrir(){
			if($this->Venta->chequear()!=null)
				$this->redirect("/Ventas/");

			if($this->request->isPost()){
				$data = $this->request->data;
				$data["tra_rut"] = $_SESSION["usuario"]->tra_rut;
				$res = $this->Venta->AbrirCaja($data);

				if(empty($res))
					$this->Session->setFlash("Ups! cometimos un error abriendo la caja","default", array("class" => "alert alert-error"));
				
				$this->redirect("/Ventas/");
			}

			$suc = $_SESSION["usuario"]->suc_id;
			$cajas = $this->Venta->getCajas($suc);
			$this->set("cajas",$cajas);

		}

		public function cerrar(){
			if($this->Venta->chequear()!=null){
				$this->Venta->CerrarCaja();
				$this->redirect("/Ventas/");
			}else
				$this->redirect("/Ventas/abrir/");
			
		}

		public function logout(){
			if($this->Venta->chequear()!=null){
				$this->Venta->CerrarCaja();
				$this->redirect("/Users/logout");
			}
			else
				$this->redirect("/Users/logout/");
			
		}

		public function add(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$sucursales=$this->Venta->mostrarSucursal();
			$clientes = $this->Venta->clientes();
				
			$this->set('Datos_sucursal',$sucursales);
			$this->set("Clientes", $clientes);
		}

		public function add2(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$consulta=$this->Venta->mostrarProductos($this->request->data);
			$this->set('Datos_productos',$consulta);

			$consulta=$this->Venta->mostrarPromociones($this->request->data);
			$this->set('Datos_promocion',$consulta);
			
			$this->set('medio_pago',$this->request->data['mediodepago']);
			$this->set('_sucursal',$this->request->data['sucursal']);
			$this->set('_mesas',$this->Venta->mesas($this->request->data['sucursal']));
			$this->set('_cliente',$this->request->data['cliente']);
		}

		public function add3(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			if($this->request->isPost()){
				$consulta=$this->Venta->comprar($this->request->data);
				
				if($consulta)
					$this->Session->setFlash("Venta Ingresada Exitosamente",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("No se pudo Ingresar la Venta, Intentalo nuevamente",'default', array("class"=>"alert alert-error"));	
			}

			$this->redirect("/Ventas");
		}

		public function colaventa(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$usu= $_SESSION['usuario'];
			$su= $usu->suc_id;
			$ped=$this->Venta->estado($su);
			$this->set("emp", $ped);
		}

		public function colaventa2(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$usu= $_SESSION['usuario'];
			$su= $usu->suc_id;
			$ped=$this->Venta->estado2($su);
			$this->set("emp", $ped);
		}

		public function ticket(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$suc = $_SESSION["usuario"]->suc_id;
			$mesas = $this->Venta->getMesas($suc);
			$this->set("actual",$mesas);	
		}

		public function ticket2(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			if($this->request->isPost()){
				$consulta=$this->Venta->Pedidomenu($this->request->data);
				//$consulta=1;
				$this->set('DatosM',$consulta);
				//$consulta=$this->Venta->Pedidoproducto($this->request->data);
				//$this->set('DatosP',$consulta);
			}
			else 
				$this->redirect("/Ventas/ticket");
		}

		public function close(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$usu= $_SESSION['usuario'];
			$su= $usu->suc_id;

			if(!$this->request->isPost()){
				$mesas = $this->Venta->getMesas($su);
				$this->set("actual", $mesas);
			}
			if($this->request->isPost()){
				
				$consulta=$this->Venta->aceptada($this->request->data);

				if(!is_null($consulta))
					$this->Session->setFlash("Venta cerrada existosamente.",'default', array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("No se pudo cerrar la venta, revise que no tenga pedidos sin cerrar.",'default', array("class"=>"alert alert-error"));
				
				$mesas = $this->Venta->getMesas($su);
				$this->set("actual", $mesas);	
				$this->redirect("/Ventas/close");
			}
		}

		public function consulta($id, $cantidad, $tipo){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$this->autoRender = false;
			$datos = array();

			if($this->Venta->consulta_stock($id, $cantidad, $tipo))
				$datos["disponible"] = true;
			else
				$datos["disponible"] = false;
			
			echo json_encode($datos);

		}

		public function aprobar(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$c = $this->Session->read("caja");
			$pendientes = $this->Venta->getClientesPendientes($c[1]);
			$this->set("pendientes", $pendientes);
		}

		public function confirmar(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$req = $this->request;

			if($req->isPost()){
				$datos = $req->data;
				
				$tmp = $this->Venta->generar_venta($datos);

				if(is_array($tmp))
					$this->Session->setFlash("Venta Realizada Exitosmanete", "default",array("class"=>"alert alert-success"));
				else
					$this->Session->setFlash("No pudimos realizar la venta, comunica con el administrador", "default",array("class"=>"alert alert-error"));
				
				$comprados[] = $datos["productos"];
				$comprados[] = $datos["promociones"];
				$envio = $this->Venta->detalles_envio($datos);
				$this->set("datos", $tmp);
				$this->set("detalles",$comprados);
				$this->set("envio",$envio);
			}
			
		}

		public function clientes(){
			if($this->Venta->chequear()==null)
				$this->redirect("/Ventas/");

			$this->autoRender = false;
			$clis = $this->Venta->getClientes();
			$tmp = array();

			foreach ($clis as $key => $value) {
				$tmp[] = $value->cli_rut;
			}

			echo json_encode($tmp);
		}
	}
?>