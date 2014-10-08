<?php

	class UsersController extends AppController{

		public $components = array('Auth', 'Session');

		public function beforeFilter(){
			parent::beforeFilter();
	     	$this->Auth->authenticate = 'Form';
	     	$this->Auth->allow('logout');
		}

		public function index(){
			$this->redirect("/users/login");
		}

		public function login(){
			if($this->request->isPost()){
				if($this->Auth->login()){
					$user = $_SESSION["usuario"];
					if(strtoupper($user->rol_nombre) == "VENDEDOR")
						$this->redirect("/Ventas");
					if(strtoupper($user->rol_nombre) == "ADMINISTRADOR")
						$this->redirect("/Admin");
					if(strtoupper($user->rol_nombre) == "CLIENTE")
						$this->redirect("/Deusuario");
				}else{
					$this->set("estado",false);
				}
			}
		}

		public function logout(){
			if($this->Auth->logout()){
				session_destroy();
				$this->redirect("/deusuario");
			}
		}


	}


?>