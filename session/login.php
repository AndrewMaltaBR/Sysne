<?php
	if(isset($_POST["return"])) {
		$data = json_decode($_POST["return"]);
		if(isset($data->id_login)){
			session_start();
			$_SESSION["session"] = $_POST["return"];
		}
	}
	header("location: ../index.php");
?>