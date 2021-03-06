<?php
	require_once("geral.php");
	require_once("login.php");

	class empresa {
		
		static function insert($email,$senha,$nome) {
			$return = 0;
			$id_login = login::insert($email,$senha);

			if($id_login > 0) {
				$nome = fix($nome);
				$con = connect();
				if($con) {
					$query = $con->query("INSERT INTO empresa(id_login,nome) VALUES($id_login,'$nome')");
					if($query) {
						$return = array();
						$return["id_login"] = $id_login;
						$return["id_empresa"] = $con->insert_id;
						$return["id_plano"] = 1;
						$return["nome"] = $nome;
						$return = json_encode($return);
					}
					$con->close();
				}
			}
			return $return;
		}

		static function insert_produto($id_empresa,$nome,$descricao,$valor,$unidade_medida) {
			$nome = fix($nome);
			$descricao = fix($descricao);
			$unidade_medida = fix($unidade_medida);
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("SELECT plano.produtos FROM plano INNER JOIN empresa ON empresa.id_plano = plano.id_plano WHERE empresa.id_empresa = '$id_empresa'");
				$row = $query->fetch_assoc();
				$query = $con->query("SELECT id_produto FROM produto WHERE id_empresa = '$id_empresa'");
				if($row["produtos"] == 99 || $row["produtos"] > $query->num_rows) {
					$query = $con->query("INSERT INTO produto(id_empresa,nome,descricao,valor,unidade_medida) VALUES($id_empresa,'$nome','$descricao',$valor,'$unidade_medida')");
					if($query)
						$return = $con->insert_id;
				}
				$con->close();
			}
			return $return;
		}

		static function update_imagem($id_produto,$imagem) {
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE produto SET imagem = '$imagem' WHERE id_produto = $id_produto");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function update_produto($id_produto,$nome,$descricao,$valor,$unidade_medida) {
			$nome = fix($nome);
			$descricao = fix($descricao);
			$unidade_medida = fix($unidade_medida);
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE produto SET nome='$nome',descricao='$descricao',valor=$valor,unidade_medida='$unidade_medida' WHERE id_produto = $id_produto");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function entrada_produto($id_produto,$quantidade) {
			$return = 0;

			$con = connect();
			if($con && $quantidade > 0) {
				$query = $con->query("INSERT INTO entrada(id_produto,quantidade) VALUES($id_produto,$quantidade)");
				$query = $con->query("UPDATE produto SET quantidade=$quantidade WHERE id_produto = $id_produto");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function bloquear_produto($id_produto) {
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE produto SET estado=1 WHERE id_produto = $id_produto");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function desbloquear_produto($id_produto) {
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE produto SET estado=0 WHERE id_produto = $id_produto");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function select_produtos($id_empresa) {
			$return = array();

			$con = connect();
			if($con) {
				$query = $con->query("SELECT * FROM produto WHERE id_empresa = $id_empresa ORDER BY estado,quantidade,nome");
				while($row = $query->fetch_assoc()) {
					$return[] = $row;
				}
			}
			return json_encode($return);
		}

		static function select_produtos_disponiveis($id_empresa) {
			$return = array();

			$con = connect();
			if($con) {
				$query = $con->query("SELECT * FROM produto WHERE id_empresa = $id_empresa AND quantidade > 0 AND estado = 0 ORDER BY estado,quantidade,nome");
				while($row = $query->fetch_assoc()) {
					$return[] = $row;
				}
			}
			return json_encode($return);
		}

		static function insert_vendedor($id_empresa,$email,$senha,$nome) {
			$return = 0;
			$id_login = login::insert($email,$senha);

			if($id_login > 0) {
				$nome = fix($nome);
				$con = connect();
				if($con) {
					$query = $con->query("INSERT INTO vendedor(id_login,id_empresa,nome) VALUES($id_login,$id_empresa,'$nome')");
					if($query)
						$return = $id_login;
					$con->close();
				}
			}
			return $return;
		}

		static function update_vendedor($id_vendedor,$email,$nome) {
			$return = 0;

			$nome = fix($nome);
			$con = connect();
			if($con) {
				$query = $con->query("SELECT id_login FROM vendedor WHERE id_vendedor = $id_vendedor");
				if($row = $query->fetch_assoc()) {
					$result = login::update($row["id_login"],$email);
					if($result > 0) {
						$query = $con->query("UPDATE vendedor SET nome='$nome' WHERE id_vendedor = $id_vendedor");
						if($query)
							$return = 1;
					}
				}
				$con->close();
			}
			return $return;
		}

		static function bloquear_vendedor($id_vendedor) {
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE vendedor SET estado=1 WHERE id_vendedor = $id_vendedor");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function desbloquear_vendedor($id_vendedor) {
			$return = 0;

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE vendedor SET estado=0 WHERE id_vendedor = $id_vendedor");
				if($query)
					$return = 1;
				$con->close();
			}
			return $return;
		}

		static function select_vendedores($id_empresa) {
			$return = array();

			$con = connect();
			if($con) {
				$query = $con->query("SELECT vendedor.*,login.email FROM vendedor INNER JOIN login ON (vendedor.id_login = login.id_login) WHERE vendedor.id_empresa = $id_empresa ORDER BY vendedor.estado,vendedor.nome");
				while($row = $query->fetch_assoc()) {
					$return[] = $row;
				}
				$con->close();
			}
			return json_encode($return);
		}

		static function insert_venda($id_empresa,$json_itens,$id_vendedor = null) {
			$return = array();

			$con = connect();
			if($con) {
				if($id_vendedor == null)
					$query = $con->query("INSERT INTO venda(id_empresa) VALUES($id_empresa)");
				else
					$query = $con->query("INSERT INTO venda(id_empresa,id_vendedor) VALUES($id_empresa,$id_vendedor)");
				if($query) {
					$return = $con->insert_id;
					$item = json_decode($json_itens);
					for($i=0;$i<count($item);$i++) {
						$query = $con->query("INSERT INTO item(id_produto,id_venda,valor,quantidade) VALUES(".$item[$i]->id_produto.",$return,".$item[$i]->valor.",".$item[$i]->quantidade.")");
					}
				}
				$con->close();
			}
			return $return;
		}

		static function confirmar_venda($id_venda) {
			$return = 0;
			$data = date("Y-m-d H:i:s");

			$con = connect();
			if($con) {
				$query = $con->query("UPDATE venda SET data_con='$data' WHERE id_venda = $id_venda");
				if($query) {
					$return = 1;
					$query = $con->query("SELECT id_produto,quantidade FROM item WHERE id_venda = $id_venda");
					while($row = $query->fetch_assoc()) {
						$sub_query = $con->query("UPDATE produto SET quantidade=(quantidade - ".$row["quantidade"].") WHERE id_produto = ".$row["id_produto"]);
					}
				}
				$con->close();
			}
			return $return;
		}

		static function select_vendas($id_empresa) {
			$return = array();

			$con = connect();
			if($con) {
				$query = $con->query("SELECT id_venda,id_vendedor,data_exp,data_con FROM venda WHERE id_empresa = $id_empresa ORDER BY data_con,data_exp DESC");
				$i = 0;
				while($row = $query->fetch_assoc()) {
					$return[$i] = $row;
					$return[$i]["data_exp"] = date_convert($return[$i]["data_exp"],false);
					$return[$i]["data_con"] = date_convert($return[$i]["data_con"],false);
					if($return[$i]["id_vendedor"] != null) {
						$sub_query = $con->query("SELECT vendedor.nome,login.email FROM vendedor INNER JOIN login ON (vendedor.id_login = login.id_login) WHERE vendedor.id_vendedor = ".$return[$i]["id_vendedor"]);
						$return[$i]["vendedor"] = $sub_query->fetch_assoc();
					}
					$sub_query = $con->query("SELECT sum(valor*quantidade) AS total FROM item WHERE id_venda = ".$row["id_venda"]);
					$row = $sub_query->fetch_assoc();
					$return[$i]["total"] = $row["total"];
					$return[$i]["total"] = number_format((float)$return[$i]["total"], 2, '.', '');
					$sub_query = $con->query("SELECT produto.nome,item.valor,produto.unidade_medida,item.quantidade FROM item INNER JOIN produto ON (item.id_produto = produto.id_produto) WHERE item.id_venda = ".$return[$i]["id_venda"]);
					while($row = $sub_query->fetch_assoc())
						$return[$i]["item"][] = $row;
					$i++;
				}
				$con->close();
			}
			return json_encode($return);
		}

		static function select_vendas_disponiveis($id_vendedor) {
			$return = array();

			$con = connect();
			if($con) {
				$query = $con->query("SELECT id_venda,id_vendedor,data_exp,data_con FROM venda WHERE id_vendedor = $id_vendedor ORDER BY data_con,data_exp DESC");
				$i = 0;
				while($row = $query->fetch_assoc()) {
					$return[$i] = $row;
					$return[$i]["data_exp"] = date_convert($return[$i]["data_exp"],false);
					$return[$i]["data_con"] = date_convert($return[$i]["data_con"],false);
					if($return[$i]["id_vendedor"] != null) {
						$sub_query = $con->query("SELECT vendedor.nome,login.email FROM vendedor INNER JOIN login ON (vendedor.id_login = login.id_login) WHERE vendedor.id_vendedor = ".$return[$i]["id_vendedor"]);
						$return[$i]["vendedor"] = $sub_query->fetch_assoc();
					}
					$sub_query = $con->query("SELECT sum(valor*quantidade) AS total FROM item WHERE id_venda = ".$row["id_venda"]);
					$row = $sub_query->fetch_assoc();
					$return[$i]["total"] = $row["total"];
					$return[$i]["total"] = number_format((float)$return[$i]["total"], 2, '.', '');
					$sub_query = $con->query("SELECT produto.nome,item.valor,produto.unidade_medida,item.quantidade FROM item INNER JOIN produto ON (item.id_produto = produto.id_produto) WHERE item.id_venda = ".$return[$i]["id_venda"]);
					while($row = $sub_query->fetch_assoc())
						$return[$i]["item"][] = $row;
					$i++;
				}
				$con->close();
			}
			return json_encode($return);
		}
	}

?>