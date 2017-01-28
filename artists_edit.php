<?php
	include("database.php");
	if($conn&&($_SESSION['admin']==1))
   	{
		print_r($_POST);
		$id= $_POST["id"];
		$name= $_POST["name"];
		$birthYear= $_POST["birthYear"];
		$deathYear= $_POST["deathYear"];
		$birthPlace=$_POST["birthPlace"];
			
		//Find location_id
		$sql = "SELECT TOP 1 id AS location_id  FROM city_country 
				WHERE country='$birthPlace';";
		$res = sqlsrv_query($conn, $sql);
		if($res){
			
		}
		else
			die( print_r( sqlsrv_errors(), true));
		$row = sqlsrv_fetch_array($res);
		$location_id=$row['location_id'];
		
        $sql = "UPDATE artist
				SET name='$name',year_of_birth=$birthYear,year_of_death=$deathYear, place_of_birth_id=$location_id
				WHERE id=$id
				;";
		print_r($sql);							
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