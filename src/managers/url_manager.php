<?php
	function generate_url($url)
	{
		// $hash = md5($url);
		// $hash = substr($hash, 0, 7);
		// return $hash;

		// generate a random string of length 7 charactere and numbers
		$hash = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(7/strlen($x)) )),1,7);
		return $hash;
	}

	function is_pattern_url_good($url)
	{
		return preg_match("/^[a-zA-Z\d]+$/", $url);
	}
?>
