<?php
	class VendedorController extends AppController{

		public function isAuthorized(){
			$usu = $_SESSION["usuario"];
			if(strtoupper($usu->rol_nombre) == "VENDEDOR")
				return true;
			else
				return false;
		}

		public function beforeFilter(){
			parent::beforeFilter();
	     	$this->layout = 'ventas';
		}

		public function index(){
		}
	}


?>