<?php
	require_once(realpath(dirname(__FILE__) . "/../db/connexion.php"));

	function insert_token($token, $email)
	{
		$query = "INSERT INTO tokens (email, token) VALUES ('$email', '$token');";
		query($query);
	}

	function find_token_by_token($token)
	{
		$query = "SELECT email, TIMESTAMPDIFF(MINUTE, CURRENT_TIMESTAMP, created) < 5 AS time_diff FROM tokens WHERE token = '$token';";
		$res = query($query);
		if ($res->num_rows != 0)
			return $res->fetch_row();
		return null;
	}

	function delete_token_by_email($email)
	{
		$query = "DELETE FROM tokens WHERE email = '$email';";
		query($query);
	}
?>
