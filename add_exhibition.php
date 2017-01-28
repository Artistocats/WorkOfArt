<?php

	require "database.php";

	if (isset($_GET['exhibitionName']))
		$exhibitionName=$_GET['exhibitionName'];
	
	if (isset($_GET['yearEstablished']))
		$yearEstablished=$_GET['yearEstablished'];
	
	if (isset($_GET['city']))
		$city=$_GET['city'];
	
	if (isset($_GET['country']))
		$country=$_GET['country'];
	
	if (isset($_GET['street']))
		$street=$_GET['street'];
	else
		$street = NULL;
	
	if (isset($_GET['num']))
		$num=$_GET['num'];
	else
		$num = NULL;
	
    if($conn)
    {
		$sql = "SELECT id FROM city_country WHERE city='$city' AND country='$country';";
		$res = sqlsrv_query($conn, $sql);
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
		
		// add the new location (every exhibition has different location from the others)	
		$sql2 = "SELECT max(id) AS maxloc_id FROM location;";
		$res2= sqlsrv_query($conn, $sql2);
		
		if($res2)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		$row = sqlsrv_fetch_array($res2);
		
		// new location has id = maximum id + 1
		$locationID = $row['maxloc_id'] + 1;
		
		if($street==NULL & $num==NULL)
			$sql3 = "INSERT INTO location VALUES('$locationID', '$city_countryID', NULL, NULL);";
		elseif($street==NULL)
			$sql3 = "INSERT INTO location VALUES('$locationID', '$city_countryID', NULL, '$num');";
		elseif($num==NULL)
			$sql3 = "INSERT INTO location VALUES('$locationID', '$city_countryID', '$street', NULL);";
		else
			$sql3 = "INSERT INTO location VALUES('$locationID', '$city_countryID', '$street', '$num');";
		
		$res3 = sqlsrv_query($conn, $sql3);
		if($res3)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		$sql = "SELECT max(id) AS maxExID FROM exhibition;";
		$res= sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);
		$exhibitionID = $row['maxExID'] + 1;
		
        $sql = "INSERT INTO exhibition VALUES('$exhibitionID', '$exhibitionName', '$yearEstablished', '$locationID');";
		$res = sqlsrv_query($conn, $sql);
		
        if($res){
			echo 'New exhibition venue was inserted successfully';
		}
		else
			die( print_r( sqlsrv_errors(), true));

    }
?>

<br><a href="exhibitions.php">Return to exhibitions</a>
