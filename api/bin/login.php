<?php 
	require_once("geral.php");
	
	class login {

		static function insert($username,$email,$senha) {
			$username = fix($username);
			$email = fix($email);
			$senha = sha1(md5($senha));

			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("INSERT INTO login(username,email,senha) VALUES('$username','$email','$senha')");
				if($query) {
					$return = $con->insert_id;
				}
				$con->close();
			}
			return $return;
		}

		static function make_login($inner,$senha) {
			$inner = fix($inner);
			$senha = sha1(md5($senha));
			$login_date = date("Y-m-d H:i:s");

			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("SELECT id_login FROM login WHERE senha = '$senha' AND (username = '$inner' OR email = '$inner')");
				if($row = $query->fetch_assoc()) {
					$id_login = $row["id_login"];
					$query = $con->query("UPDATE login SET last = '$login_date' WHERE id_login = $id_login");
					$query = $con->query("SELECT id_empresa,id_plano,nome FROM empresa WHERE id_login = $id_login");
					if($row = $query->fetch_assoc()) {
						$row["id_login"] = $id_login;
						$return = json_encode($row);
					}
					else {
						$query = $con->query("SELECT id_vendedor,id_empresa,nome FROM empresa WHERE id_login = $id_login");
						if($row = $query->fetch_assoc()) {
							$row["id_login"] = $id_login;
							$return = json_encode($row);
						}
					}
				}
				$con->close();
			}
			return $return;
		}
	}

?>