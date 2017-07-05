<?php
	require_once("geral.php");
	require_once("login.php");

	class empresa {
		
		static function insert($username,$email,$senha,$id_plano,$nome) {
			$return = 0;
			$id_login = login::insert($username,$email,$senha);

			if($id_login > 0) {
				$nome = fix($nome);
				$con = connect();
				if($con) {
					$query = $con->query("INSERT INTO empresa(id_plano,id_login,nome) VALUES($id_plano,$id_login,'$nome')");
					if($query) {
						$return = $con->insert_id;
					}
					$con->close();
				}
			}
			return $return;
		}
	}

?>