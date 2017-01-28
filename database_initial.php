<?php
	$serverName = "";	//serverName\instanceName e.g "MYPC\SQLEXPRESS"
	$admin = "";	//e.g. "sa"
	$adminpass = "";	//e.g. "sapassword"

	$conn=false;
	session_start();

	//Keep user logged in
	if (isset($_SESSION['username'])&&isset($_SESSION['password']))
	{
		$connectionInfo = array( "Database"=>"workofart", "UID"=>$_SESSION['username'], "PWD"=>$_SESSION['password']);
		$conn = sqlsrv_connect($serverName, $connectionInfo);
	}

?>