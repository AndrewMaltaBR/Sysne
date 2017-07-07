<?php
	session_start();

	if(!isset($_SESSION["session"])) {
		header("location: ../index.php");
	}
?>