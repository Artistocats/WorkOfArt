<?php
	require "database.php";
	$username = $_POST[ 'username' ];
    $password = $_POST[ 'password' ];
	$email = $_POST[ 'email' ];
	if ($username==""||$password==""||$email=="")
	{
		$_SESSION['fl']=2;
		header("Location: index.php");
		exit;
	}

    $connectionInfo = array( "Database"=>"workofart", "UID"=>$admin, "PWD"=>$adminpass);
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	if($conn)
	{
		$sql ="SELECT username FROM users WHERE username = '$username' OR email = '$email';";
    	$res = sqlsrv_query($conn, $sql);
    	if(sqlsrv_has_rows($res))
    		$_SESSION['fl'] = 3;
    	else
    	{
    		$sql="	CREATE LOGIN $username WITH PASSWORD = '$password', DEFAULT_DATABASE=workofart;
					USE workofart;
					IF NOT EXISTS (SELECT * FROM sys.database_principals WHERE name = '$username')
					BEGIN
					    CREATE USER [$username] FOR LOGIN [$username]
					    EXEC sp_addrolemember users, '$username'
					END;";
			
			$res = sqlsrv_query($conn, $sql);

			if($res)
			{
				$sql="	INSERT INTO users (username,email)
			 		 	VALUES ('$username','$email');							
					 "
				;
				$res = sqlsrv_query($conn, $sql);

				if($res)
				{
					sqlsrv_close($conn);

					//Log in with the new account
					$connectionInfo = array( "Database"=>"workofart", "UID"=>$username, "PWD"=>$password);
					$conn = sqlsrv_connect($serverName, $connectionInfo);
					if($conn)
					{
						$sql = "SELECT CURRENT_USER;";
						$res = sqlsrv_query($conn, $sql);
						if(sqlsrv_has_rows($res))
						{
							$user = sqlsrv_fetch_array($res);
							$_SESSION['username'] = $user[''];
							$_SESSION['password'] = $password;
							$_SESSION['admin'] = 0;
    					}
					}
    			}
    		}
    	
		}
	}

	header("Location: index.php");
?>
