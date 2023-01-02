<?php
	function generate_token()
	{
		$MAX_LETTER = 15;

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$random_string = '';
		for ($i = 0; $i != $MAX_LETTER; $i++)
		{
			$index = rand(0, strlen($characters) - 1);
			$random_string .= $characters[$index];
		}
		return md5($random_string);
	}
?>
