<?php
	require_once(realpath(dirname(__FILE__) . "/../db/connexion.php"));

	function find_url_by_long_url($long_url, $email)
	{
		// si long url n'a pas https ou http, on l'ajoute
		if (substr($long_url, 0, 4) != "http")
			$long_url = "http://" . $long_url;

		if ($email)
			$query = "SELECT email, short_url, nb_click FROM urls WHERE long_url = '$long_url' AND email = '$email';";
		else
			$query = "SELECT email, short_url, nb_click FROM urls WHERE long_url = '$long_url' AND email IS NULL;";

		$res = query($query);
		if ($res->num_rows != 0)
			return $res->fetch_row();
		return null;
	}

	function find_url_by_short_url($short_url){
		$query = "SELECT email, long_url, nb_click FROM urls WHERE short_url = '$short_url';";
		$res = query($query);
		if ($res->num_rows != 0)
			return $res->fetch_row();
		return null;
	}

	function insert_url($email, $short_url, $long_url)
	{
		if ($email)
			$query = "INSERT INTO urls (email, short_url, long_url) VALUES ('$email', '$short_url', '$long_url');";
		else
			$query = "INSERT INTO urls (short_url, long_url) VALUES ('$short_url', '$long_url');";
		query($query);
	}

	function is_short_url_exists($short_url, $email)
	{
		$query = "SELECT 1 FROM urls WHERE short_url = '$short_url' AND email = '$email';";
		$res = query($query);
		if ($res->num_rows != 0)
			return 1;
		return 0;
	}

	function get_all_url_by_email($email)
	{
		$query = "SELECT short_url, long_url, nb_click FROM urls WHERE email = '$email';";
		return query($query);
	}

  	function increment_nb_click_by_short_url($short_url)
  	{
		$query = "UPDATE urls SET nb_click = nb_click + 1 WHERE short_url = '$short_url';";
		query($query);
	}

	function delete_url($short_url, $email)
	{
		$query = "DELETE FROM urls WHERE short_url = '$short_url' AND email = '$email';";
		query($query);
	}

	function update_short_url($short_url, $modify_short_url, $email)
	{
		$query = "UPDATE urls SET short_url = '$modify_short_url' WHERE short_url = '$short_url' AND email = '$email';";
		query($query);
	}
