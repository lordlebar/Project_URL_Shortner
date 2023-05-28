<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/db/config.php";

	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_BASE);

	session_start();


	if (mysqli_connect_errno())
	{
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
	}

	function query($query)
	{
		global $con;
		$res = $con->query($query);
		if (!$res)
		{
			echo $con->error;
			exit();
		}
		return $res;
	}
?>
