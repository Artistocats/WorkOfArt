<?php

	require "database.php";

	if (isset($_GET['artistName']))
		$artistName=$_GET['artistName'];
	
	if (isset($_GET['yearBorn']))
		$yearBorn=$_GET['yearBorn']; 
	else
		$yearBorn=NULL;

	if (isset($_GET['birthCity']))
		$birthCity=$_GET['birthCity'];
	
	if (isset($_GET['birthCountry']))
		$birthCountry=$_GET['birthCountry'];
	
	if (isset($_GET['yearDied']))
		$yearDied=$_GET['yearDied'];
	else
		$yearDied=NULL;
	
	
    if($conn)
    {
		
		$sql = "SELECT id FROM city_country WHERE city='$birthCity' AND country='$birthCountry';";
		$res = sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);
		
		// if the city, country do not exist add them to the city_country table
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

			$sql3 = "INSERT INTO city_country VALUES('$city_countryID','$birthCity', '$birthCountry');";
			$res3 = sqlsrv_query($conn, $sql3);
			if($res3)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
		}
		else{
			$city_countryID = $row['id'];
		}	
		
		$sql = "SELECT max(id) AS max_id FROM artist;";
		$res = sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);
		
			
		// new artist has id = maximum id + 1
		$artistID = $row['max_id'] + 1;

		if($yearBorn==NULL & $yearDied==NULL){
			$sql = "INSERT INTO artist VALUES('$artistID', '$artistName', NULL, NULL, '$city_countryID');";
		}	
		elseif($yearBorn==NULL){
			$sql = "INSERT INTO artist VALUES('$artistID', '$artistName', NULL, '$yearDied', '$city_countryID');";				
		}
		elseif($yearDied==NULL){
			$sql = "INSERT INTO artist VALUES('$artistID', '$artistName', $yearBorn, NULL, '$city_countryID');";
		}
		else{
			$sql = "INSERT INTO artist VALUES('$artistID', '$artistName', '$yearBorn', '$yearDied', '$city_countryID');";			
		}
		
		$res = sqlsrv_query($conn, $sql);
        if($res){
			echo 'New artist was inserted successfully';
		}
		else
			die( print_r( sqlsrv_errors(), true));
		
    }
?>

<br><a href="artists.php">Return to artist</a>