<?php
	require "database.php";

	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['admin']);
	session_destroy();

	if($conn)
		sqlsrv_close($conn);

	header("Location: index.php");
?>