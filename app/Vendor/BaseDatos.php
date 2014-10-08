<?php 

	class BaseDatos{

		private $link;

		public function __construct(){
			$this->link = pg_connect("host=localhost dbname=Furai port=5432 user=edgardo");
		}


		public function select_query($query){
			$response = pg_query($query);
			if(pg_num_rows($response) > 0){
				$tmp = array();
				while($obj = pg_fetch_object($response))
					$tmp[] = $obj;
				return $tmp;
			}else{
				return null;
			}
		}

		public function insert_query($query){
			$response = pg_query($query);
			if(pg_affected_rows($response) > 0)
				return true;
			else
				return false;
		}

	}


?>