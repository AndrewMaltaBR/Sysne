<?php
	header('Access-Control-Allow-Origin: *');
	error_reporting(E_ALL);
	ini_set("display_errors",1);

	require_once("bin/geral.php");
	require_once("bin/login.php");
	require_once("bin/empresa.php");

	$method = null;
	$class = null;

	if(isset($_POST["method"]))
		$method = $_POST["method"];

	if(isset($_POST["class"]))
		$class = $_POST["class"];

	if($class == "empresa") {

		if($method == "insert")
			echo empresa::insert($_POST["email"],$_POST["senha"],$_POST["nome"]);

		if($method == "insert_produto")
			echo empresa::insert_produto($_POST["id_empresa"],$_POST["nome"],$_POST["descricao"],$_POST["valor"],$_POST["unidade_medida"]);
		if($method == "update_imagem")
			echo empresa::update_imagem($_POST["id_produto"],$_POST["imagem"]);
		if($method == "update_produto")
			echo empresa::update_produto($_POST["id_produto"],$_POST["nome"],$_POST["descricao"],$_POST["valor"],$_POST["unidade_medida"]);
		if($method == "entrada_produto")
			echo empresa::entrada_produto($_POST["id_produto"],$_POST["quantidade"]);
		if($method == "bloquear_produto")
			echo empresa::bloquear_produto($_POST["id_produto"]);
		if($method == "desbloquear_produto")
			echo empresa::desbloquear_produto($_POST["id_produto"]);
		if($method == "select_produtos")
			echo empresa::select_produtos($_POST["id_empresa"]);
		if($method == "select_produtos_disponiveis")
			echo empresa::select_produtos_disponiveis($_POST["id_empresa"]);

		if($method == "insert_vendedor")
			echo empresa::insert_vendedor($_POST["id_empresa"],$_POST["email"],$_POST["senha"],$_POST["nome"]);
		if($method == "update_vendedor")
			echo empresa::update_vendedor($_POST["id_vendedor"],$_POST["email"],$_POST["nome"]);
		if($method == "bloquear_vendedor")
			echo empresa::bloquear_vendedor($_POST["id_vendedor"]);
		if($method == "desbloquear_vendedor")
			echo empresa::desbloquear_vendedor($_POST["id_vendedor"]);
		if($method == "select_vendedores")
			echo empresa::select_vendedores($_POST["id_empresa"]);

		if($method == "insert_venda") {
			if(isset($_POST["id_vendedor"]))
				echo empresa::insert_venda($_POST["id_empresa"],$_POST["json_itens"],$_POST["id_vendedor"]);
			else
				echo empresa::insert_venda($_POST["id_empresa"],$_POST["json_itens"]);
		}
		if($method == "confirmar_venda")
			echo empresa::confirmar_venda($_POST["id_venda"]);
		if($method == "select_vendas")
			echo empresa::select_vendas($_POST["id_empresa"]);
		if($method == "select_vendas_disponiveis")
			echo empresa::select_vendas_disponiveis($_POST["id_vendedor"]);
	}
	else {

		if($method == 'select_planos')
			echo select_planos();
		if($method == 'make_login')
			echo login::make_login($_POST["email"],$_POST["senha"]);
	}
?>