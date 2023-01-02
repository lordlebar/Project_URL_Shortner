<?php
	require_once(realpath(dirname(__FILE__) . "/../db/connexion.php"));

	function is_email_exists($email)
	{
		$query = "SELECT 1 FROM users WHERE email = '$email';";
		$res = query($query);
		if ($res->num_rows != 0)
			return 1;
		return 0;
	}

	function insert_user($name, $email, $password, $is_admin, $is_verified)
	{
		$query = "INSERT INTO users (name, email, password, is_admin, is_verified) VALUES ('$name', '$email', '$password', $is_admin, $is_verified);";
		query($query);
	}

	function find_user_by_email($email)
	{
		$query = "SELECT name, email, password, is_admin, is_verified FROM users WHERE email = '$email';";
		$res = query($query);
		if ($res->num_rows != 0)
			return $res->fetch_row();
		return 0;
	}

	function set_user_verified($email, $is_verified)
	{
		$query = "UPDATE users SET is_verified = $is_verified WHERE email = '$email';";
		query($query);
	}

	function delete_user_by_email($email)
	{
		$admin = find_user_by_email($email);
		$is_admin = $admin[3];
		if ($is_admin == 1)
			return 0;

		$query = "DELETE FROM users WHERE email = '$email';";
		query($query);
		$DeleteUrl_from_this_email = "DELETE FROM urls WHERE email = '$email';";
		query($DeleteUrl_from_this_email);
	}
	function get_all_users()
	{
		$query = "SELECT name, email, is_verified, is_admin FROM users;";
		$res = query($query);
		return $res->fetch_all();
	}

	function modify_passord_user($password, $email){
		$query = "UPDATE users SET password = '$password' WHERE email = '$email';";
		query($query);
	}
	// $2y$10$OQTiatnbUA8LclO9R2KjTOHd5tnz0T/6onQbfhRB0TKieaLPJd6jS
?>
