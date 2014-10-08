<?php
	class AdminController extends AppController{

		public function isAuthorized(){
			$usu = $_SESSION["usuario"];
			if(strtoupper($usu->rol_nombre) == "ADMINISTRADOR")
				return true;
			else
				return false;
		}

		public function beforeFilter(){
			parent::beforeFilter();
	     	$this->layout = 'admin';
		}

		public function index(){
		}
	}


?>