<?php 
	require_once("geral.php");
	
	class login {

		static function insert($email,$senha) {
			$email = fix($email);
			$senha = sha1(md5($senha));

			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("INSERT INTO login(email,senha) VALUES('$email','$senha')");
				if($query) {
					$return = $con->insert_id;
				}
				$con->close();
			}
			return $return;
		}

		static function update($id_login,$email) {
			$email = fix($email);

			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE login SET email='$email' WHERE id_login = $id_login");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function make_login($email,$senha) {
			$email = fix($email);
			$senha = sha1(md5($senha));
			$login_date = date("Y-m-d H:i:s");

			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("SELECT id_login, estado FROM login WHERE senha = '$senha' AND email = '$email'");
				if($row = $query->fetch_assoc()) {
					$id_login = $row["id_login"];
					if($row["estado"] == 0) {
						$query = $con->query("SELECT id_login,id_empresa,id_plano,nome FROM empresa WHERE id_login = $id_login");
						if($return = $query->fetch_assoc()) {
							$query = $con->query("UPDATE login SET last = '$login_date' WHERE id_login = $id_login");
							$return = json_encode($return);
						}
						else {
							$query = $con->query("SELECT id_login,id_vendedor,id_empresa,nome FROM vendedor WHERE id_login = $id_login AND estado = 0");
							if($return = $query->fetch_assoc()){
								$query = $con->query("UPDATE login SET last = '$login_date' WHERE id_login = $id_login");
								$return = json_encode($return);
							}
						}
					}
					else
						$return = -1;
				}
				$con->close();
			}
			return $return;
		}
	}

?>