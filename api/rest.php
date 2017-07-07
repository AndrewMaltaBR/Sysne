<?php
	header('Access-Control-Allow-Origin: *');
	//error_reporting(E_ALL);
	//ini_set("display_errors",0);

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
			echo empresa::insert($_POST["username"],$_POST["email"],$_POST["senha"],$_POST["nome"]);
	}
	else {

		if($method == 'select_planos')
			echo select_planos();

		if($method == 'make_login')
			echo login::make_login($_POST["inner"],$_POST["senha"]);
	}
?>