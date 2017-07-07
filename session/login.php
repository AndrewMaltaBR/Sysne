<?php
	if(isset($_POST["return"])) {
		session_start();
		$_SESSION["session"] = $_POST["return"];
	}
	header("location: ../index.php");
?>