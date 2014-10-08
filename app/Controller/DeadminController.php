<?php
	App::uses("AdminController","Controller");

	class DeadminController extends AdminController{

		public function index(){
			if($this->request->isPost()){
				$Fecha=$this->request->data['Fecha'];
				$Sucursal=$this->request->data['selectSucursal'];

				$ventas=$this->Deadmin->get_ventasporsucursal($Fecha,$Sucursal);
				$sucursales=$this->Deadmin->sucursales();
					
				$this->set('Fecha',$Fecha);
				$this->set('Ventas',$ventas);
				$this->set('Sucursal',$sucursales);
			}
			else{
				$Fecha=date('Y-m-d');
				$ventas=$this->Deadmin->get_ventas($Fecha);
				$sucursales=$this->Deadmin->sucursales();

				$this->set('Fecha',$Fecha);
				$this->set('Ventas',$ventas);
				$this->set('Sucursal',$sucursales);
			}
		}

		public function view($Id){
			$consulta1=$this->Deadmin->buscarVenta($Id);
			$consulta2=$this->Deadmin->buscarMenus($Id);
			$consulta3=$this->Deadmin->buscarProductos($Id);

			$this->set('Venta',$consulta1);
			$this->set('Menus',$consulta2);
			$this->set('Productos',$consulta3);
		}
	}


?>