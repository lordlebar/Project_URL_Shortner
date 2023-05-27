<?php
	if (!isset($_SESSION)){
		session_start();
	}
	// require_once("mail_manager.php");
	require_once("sql_token_manager.php");
	require_once("sql_user_manager.php");
	require_once("token_manager.php");
	require_once("sql_url_manager.php");
	require_once("url_manager.php");


