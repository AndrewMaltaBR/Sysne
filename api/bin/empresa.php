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

		tatic function insert_produto($id_empresa,$nome,$descricao,$imagem,$valor) {
			$nome = fix($nome);
			$descricao = fix($descricao);
			if(!imagem != null)
				$imagem = "'"+fix($imagem)+"'";
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("SELECT plano.produtos FROM plano INNER JOIN empresa ON empresa.id_plano = plano.id_plano WHERE empresa.id_empresa = '$id_empresa'");
				$row = $query->fetch_assoc();
				$query = $con->query("SELECT id_produto FROM produto WHERE id_empresa = '$id_empresa'");
				if($row["produtos"] == 99 || $row["produtos"] > $query->num_rows) {
					$query = $con->query("INSERT INTO produto(id_empresa,nome,descricao,imagem,valor) VALUES($id_empresa,'$nome','$descricao',$imagem,$valor)");
					if($query)
						$return = $con->insert_id;
					$con->close();
				}
			}
			return $return;
		}

		static function select_produtos($id_empresa) {
			$return = array();

			$con = connect();
			if($con) {
				$query = $con->query("SELECT * FROM produto WHERE id_empresa = $id_empresa ORDER BY quantidade,nome");
				while($row = $query->fetch_assoc()) {
					$return[] = $row;
				}
			}
			return json_encode($return);
		}
	}

?>