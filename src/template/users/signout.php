<?php
	session_start();
	unset($_SESSION["is_logged"]);
	unset($_SESSION["name"]);
	unset($_SESSION["email"]);
	unset($_SESSION["is_admin"]);

	header("Location: ../../../");
	die();
?>
