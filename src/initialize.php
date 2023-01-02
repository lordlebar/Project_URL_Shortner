<?php
	session_start();

	$dir_name = dirname(__FILE__);
	require_once(realpath("$dir_name/managers/mail_manager.php"));
	require_once(realpath("$dir_name/managers/sql_token_manager.php"));
	require_once(realpath("$dir_name/managers/sql_user_manager.php"));
	require_once(realpath("$dir_name/managers/token_manager.php"));
	require_once(realpath("$dir_name/managers/sql_url_manager.php"));
	require_once(realpath("$dir_name/managers/url_manager.php"));
?>
