<?php
	require "database.php";
	include "header.php";
	
	if($conn)
    {
   	if($_SESSION['admin']==1)
   	{
   		if(isset($_GET['artist_id']))
   		{
			$id=$_GET['artist_id'];
			$sql = "DELETE FROM artist WHERE id=$id;";
			$res = sqlsrv_query($conn, $sql);
			print_r($sql);
			if($res){}
			else
				die( print_r( sqlsrv_errors(), true));
   			header( "Location: artists.php" );
   		}
   		else if(isset($_GET['exhibit_id']))
   		{
			$id=$_GET['exhibit_id'];
			$sql = "DELETE FROM exhibit WHERE id=$id;";
			$res = sqlsrv_query($conn, $sql);
			if($res){}
			else
				die( print_r( sqlsrv_errors(), true));
   			header( "Location: exhibits.php" );
   		}
   		else if(isset($_GET['movement_id']))
   		{
			$id=$_GET['movement_id'];
			$sql = "DELETE FROM art_movement WHERE id=$id;";
			$res = sqlsrv_query($conn, $sql);
			if($res){}
			else
				die( print_r( sqlsrv_errors(), true));
   			header( "Location: movements.php" );
   		}
   		else if(isset($_GET['exhibition_id']))
   		{
			$id=$_GET['exhibition_id'];
			$sql = "DELETE FROM exhibition WHERE id=$id;";
			$res = sqlsrv_query($conn, $sql);
			if($res){}
			else
				die( print_r( sqlsrv_errors(), true));
   			header( "Location: exhibitions.php" );
   		}
   		else if(isset($_GET['username']))
   		{
			$username=$_GET['username'];
 			$sql = "DELETE FROM users WHERE username='$username';";
			$res = sqlsrv_query($conn, $sql);
			print_r($sql);
			if($res){}
			else
				die( print_r( sqlsrv_errors(), true));
			
			$sql = "IF EXISTS (SELECT name FROM master.sys.server_principals WHERE name = '$username')
					BEGIN
						USE [master]
						DROP LOGIN $username;
					END
					BEGIN
						USE [workofart]
						DROP USER $username;
					END

					";
			$res = sqlsrv_query($conn, $sql);		
						if($res){}
			else
				die( print_r( sqlsrv_errors(), true));
			
   			header( "Location: users.php" );
   		}

   	}
	}
?>
