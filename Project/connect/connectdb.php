<?php
	$serverName	  = "localhost";
	$userName	  = "root";
	$userPassword	  = "";
	$dbName	  = "Shop";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_set_charset($conn, 'utf8');

	if (mysqli_connect_errno())
	{
		echo "Database Connect Failed : " . mysqli_connect_error();
		exit();
	}
    else{
        echo"Connect";
    }
?>
