<?php
	require_once("geral.php");
	require_once("login.php");

	class empresa {
		
		static function insert($username,$email,$senha,$nome) {
			$return = 0;
			$id_login = login::insert($username,$email,$senha);

			if($id_login > 0) {
				$nome = fix($nome);
				$con = connect();
				if($con) {
					$query = $con->query("INSERT INTO empresa(id_login,nome) VALUES($id_login,'$nome')");
					if($query) {
						$return = array();
						$return["id_login"] = $id_login;
						$return["id_empresa"] = $con->insert_id;
						$return["nome"] = $nome;
						json_encode($return);
					}
					$con->close();
				}
			}
			return $return;
		}
	}

?>