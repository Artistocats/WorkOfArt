<?php
	require "database.php";
    $username = $_POST[ 'username' ];
    $password = $_POST[ 'password' ];
    $connectionInfo = array( "Database"=>"workofart", "UID"=>$username, "PWD"=>$password);
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	if($conn)
	{
		$sql = "SELECT SYSTEM_USER;";
		$res = sqlsrv_query($conn, $sql);
		if($res)
		{
			$user = sqlsrv_fetch_array($res);
			$_SESSION['username'] = $user[''];
			$_SESSION['password'] = $password;

			//Check if user is admin
			$_SESSION['admin'] = 0;
			$sql = "SELECT IS_SRVROLEMEMBER ('sysadmin');";

			$res = sqlsrv_query($conn, $sql);

			
			if($res)
			{
				$admin = sqlsrv_fetch_array($res);
				$_SESSION['admin'] = $admin[''];
			}
    	}
	}
	else
		$_SESSION['fl']=1;


	header( "Location: index.php" );
?>
