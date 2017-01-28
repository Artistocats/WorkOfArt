<?php

	require "database.php";
	
	$id= $_POST["id"];
	$name= $_POST["name"];
	$year= $_POST["year"];
	$country= $_POST["country"];
	$city= $_POST["city"];
	$street= $_POST["street"];
	$number= $_POST["number"];
	
    if($conn && ($_SESSION['admin']==1))
    {
		$sql = "SELECT id FROM city_country WHERE city='$city' AND country='$country';";
		$res = sqlsrv_query($conn, $sql);
		if($res)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
		
		$row = sqlsrv_fetch_array($res);
		
		// if city, country do not exist add them to the city_country table
		if($row['id']==NULL){
			$sql2 = "SELECT max(id) AS maxCC_id FROM city_country;";
			$res2= sqlsrv_query($conn, $sql2);
			
			if($res2)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
			
			$row = sqlsrv_fetch_array($res2);
			
			// new city_country has id = maximum id + 1
			$city_countryID = $row['maxCC_id'] + 1;

			$sql3 = "INSERT INTO city_country VALUES('$city_countryID','$city', '$country');";
			$res3 = sqlsrv_query($conn, $sql3);
			if($res3)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
		}
		else{
			$city_countryID = $row['id'];
		}
		
		$sql = "SELECT location_id FROM exhibition WHERE id=$id;";
		$res = sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);
		if($res)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
			
		$locationID = $row['location_id'];
		
		
		/* update the location (every exhibition has different location from the others, 
			so update does not affect other exhibitions)	*/	
		
		
		if($street==NULL && $number==NULL){
			$sql3 = "UPDATE location SET city_country_id=$city_countryID, street=NULL, number=NULL
			WHERE id=$locationID;";
		}	
		elseif($street==NULL){
			$sql3 = "UPDATE location SET city_country_id=$city_countryID, street=NULL, number=$number 
			WHERE id=$locationID;";
		}	
		elseif($number==NULL){
			$sql3 = "UPDATE location SET city_country_id=$city_countryID, street='$street', number=NULL 
			WHERE id=$locationID;";
		}	
		else{
			$sql3 = "UPDATE location SET city_country_id=$city_countryID, street='$street', number=$number 
			WHERE id=$locationID;";
		}	

		$res3 = sqlsrv_query($conn, $sql3);
		if($res3)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
        $sql = "UPDATE exhibition
				SET name='$name', year_established=$year, location_id=$locationID
				WHERE id=$id;";
		$res = sqlsrv_query($conn, $sql);
		
        if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));

    }
	else{
        $_SESSION['fl']=4;
        header("Location: index.php");
    }
?>
