<?php
	echo "testing site";

	require_once 'login.php';
	$conn = new mysqli($hm, $un, $pw, $db);
	if ($conn->connect_error) 
		die($conn->connect_error);

	$test
?>
