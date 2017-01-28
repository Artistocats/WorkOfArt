<?php

    require "database.php" ;
	if($conn&&($_SESSION['admin']==1))
   	{
   		if (isset($_POST['oldName']))
			$oldName=$_POST['oldName'];
		else
			header("Location: users.php");

   		if (isset($_POST['name']))
			$name=$_POST['name'];
		else
			header("Location: users.php");
   		if (isset($_POST['email']))
			$email=$_POST['email'];
		else
			header("Location: users.php");


        $sql = "UPDATE users SET username='$name',email='$email' WHERE username='".$oldName."';";
		$res = sqlsrv_query($conn, $sql);
        if($res)
		{}	//echo 'Success(1)';
		else
			die( print_r( sqlsrv_errors(), true));


		$sql = "ALTER USER ".$oldName." WITH NAME = ".$name.";";
		$res = sqlsrv_query($conn, $sql);
		if($res)
		{}	//echo 'Success(2)';
		else
			die( print_r( sqlsrv_errors(), true));


		$sql = "ALTER LOGIN ".$oldName." WITH NAME = ".$name.";";
		$res = sqlsrv_query($conn, $sql);
		if($res)
		{}	//echo 'Success(3)';
		else
			die( print_r( sqlsrv_errors(), true));

    }
	else
    {
        $_SESSION['fl']=4;
        header("Location: index.php");
    }
	
?>