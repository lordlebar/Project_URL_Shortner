<?php
	require_once("config.php");

	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_BASE);

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
