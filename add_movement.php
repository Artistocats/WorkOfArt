<?php

	require "database.php";

	if (isset($_GET['movementName']))
		$movementName=$_GET['movementName'];
	
	if (isset($_GET['fromYear']))
		$fromYear=$_GET['fromYear']; 
	else
		$fromYear=NULL;

	if (isset($_GET['untilYear']))
		$untilYear=$_GET['untilYear'];
	else
		$untilYear=NULL;
	
	
    if($conn)
    {
		
		$sql = "SELECT max(id) AS max_id FROM art_movement;";
		$res = sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);
		
			
		// new movement has id = maximum id + 1
		$movementID = $row['max_id'] + 1;

		if($fromYear==NULL & $untilYear==NULL){
			$sql = "INSERT INTO art_movement VALUES('$movementID', '$movementName', NULL, NULL);";
		}	
		elseif($fromYear==NULL){
			$sql = 	"INSERT INTO art_movement VALUES('$movementID', '$movementName', NULL, '$untilYear');";			
		}
		elseif($untilYear==NULL){
			$sql = "INSERT INTO art_movement VALUES('$movementID', '$movementName', '$fromYear', NULL);";
		}
		else{
			$sql = "INSERT INTO art_movement VALUES('$movementID', '$movementName', '$fromYear', '$untilYear');";
		}
		
		$res = sqlsrv_query($conn, $sql);
       
		header("Location: movements.php");
    }
?>
