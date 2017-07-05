<?php
	header('Access-Control-Allow-Origin: *');
	//error_reporting(E_ALL);
	//ini_set("display_errors",0);

	require_once("bin/geral.php");
	require_once("bin/login.php");
	require_once("bin/empresa.php");

	if(isset($_POST["method"])) {
		$method = $_POST["method"];

		if($method == 'select_planos')
			echo select_planos();
	}
?>