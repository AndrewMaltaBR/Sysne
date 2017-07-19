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
			echo empresa::insert_produto($_POST["id_empresa"],$_POST["nome"],$_POST["descricao"],$_POST["valor"]);
		if($method == "update_imagem")
			echo empresa::update_imagem($_POST["id_produto"],$_POST["imagem"]);
		if($method == "select_produtos")
			echo empresa::select_produtos($_POST["id_empresa"]);
	}
	else {

		if($method == 'select_planos')
			echo select_planos();
		if($method == 'make_login')
			echo login::make_login($_POST["email"],$_POST["senha"]);
	}
?>