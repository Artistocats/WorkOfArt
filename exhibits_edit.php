<?php
	include("database.php");
	if($conn&&($_SESSION['admin']==1))
   	{
		print_r($_POST);
		$id= $_POST["id"];
		$title= $_POST["exhibit"];
		$year= $_POST["year"];
		$exhibition= $_POST["exhibition"];
		$movement= $_POST["movement"];
		$artists= $_POST["artists"][0];

		//Find exhibition_id
		$sql = "SELECT id AS exhibition_id FROM exhibition WHERE name='$exhibition';";
		$res = sqlsrv_query($conn, $sql);
        if($res){
			
		}
		else
			die( print_r( sqlsrv_errors(), true));		
		$row = sqlsrv_fetch_array($res);
		$exhibition_id=$row['exhibition_id'];
		//Find movement_id
		$sql = "SELECT id AS movement_id FROM art_movement WHERE name='$movement';";
		$res = sqlsrv_query($conn, $sql);
        if($res){
			
		}
		else
			die( print_r( sqlsrv_errors(), true));		
		$row = sqlsrv_fetch_array($res);
		$movement_id=$row['movement_id'];
		//Find artist_id
		$sql = "SELECT id AS artist_id FROM artist WHERE name='$artists';";
		$res = sqlsrv_query($conn, $sql);
        if($res){
			
		}
		else
			die( print_r( sqlsrv_errors(), true));		
		$row = sqlsrv_fetch_array($res);
		$artist_id=$row['artist_id'];		
		//Update exhibit
        $sql = "UPDATE exhibit
				SET title='$title',year_created=$year,exhibition_id=$exhibition_id,movement_id=$movement_id
				WHERE id=$id
				;";						
        $res = sqlsrv_query($conn, $sql);
        if($res){
			
		}
		else
			die( print_r( sqlsrv_errors(), true));		
		//Update exhibit_artist
        $sql = "UPDATE exhibit_artist
				SET artist_id=$artist_id
				WHERE exhibit_id=$id 
				;";
		$res = sqlsrv_query($conn, $sql);		
        if($res){
			
		}
		else
			die( print_r( sqlsrv_errors(), true));
		
	}
	else
    {
        $_SESSION['fl']=4;
        header("Location: index.php");
    }
?>