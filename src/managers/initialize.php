<?php
	session_start();

	$dir_name = dirname(__FILE__);
	require_once(realpath("$dir_name/mail_manager.php"));
	require_once(realpath("$dir_name/sql_token_manager.php"));
	require_once(realpath("$dir_name/sql_user_manager.php"));
	require_once(realpath("$dir_name/token_manager.php"));
	require_once(realpath("$dir_name/sql_url_manager.php"));
	require_once(realpath("$dir_name/url_manager.php"));
