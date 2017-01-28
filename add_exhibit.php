<?php

	require "database.php";

	if (isset($_GET['title']))
		$title=$_GET['title'];
	
	if (isset($_GET['artist']))
		$artist=$_GET['artist'];
	
	if (isset($_GET['yearCreated']))
		$yearCreated=$_GET['yearCreated'];
	
	if (isset($_GET['description']))
		$description=$_GET['description'];
	
	if (isset($_GET['movement']))
		$movement=$_GET['movement'];
	
	if (isset($_GET['exhibition']))
		$exhibition=$_GET['exhibition'];
	
	if (isset($_GET['type']))
		$type=$_GET['type'];
	
	if ($type=='painting'){
		$length = $_GET['length'];
		$width = $_GET['width'];
		$paintType = $_GET['paintType'];
		
	}else if ($type=='drawing'){
		$base = $_GET['base'];
		$tool = $_GET['tool'];
		$drawType = $_GET['drawType'];
		
	}else if ($type=='sculpture'){
		$material = $_GET['material'];
		$height = $_GET['height'];
		
	}else{
		$technique = $_GET['technique'];
	}	
	
    if($conn)
    {
		/* insert new exhibit into the database*/
		$sql = "SELECT max(id) AS maxExhID FROM exhibit";
		$res = sqlsrv_query($conn, $sql);
		if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		$row = sqlsrv_fetch_array($res);
		// new exhibit has id = maximum id + 1
		$exhibitID = $row['maxExhID'] + 1;
		
		// find art movement id
		$sql = "SELECT id AS moveID FROM art_movement WHERE name='$movement'";
		$res = sqlsrv_query($conn, $sql);
		if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		$row = sqlsrv_fetch_array($res);
		$movementID = $row['moveID'];
		
		// find exhibition id
		$sql = "SELECT id AS exhibitionID FROM exhibition WHERE name='$exhibition'";
		$res = sqlsrv_query($conn, $sql);
		if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		$row = sqlsrv_fetch_array($res);
		$exhibitionID = $row['exhibitionID'];
		
		
		$sql = "INSERT INTO exhibit VALUES('$exhibitID', '$title', '$yearCreated', '$description', '$movementID', '$exhibitionID');";
		$res = sqlsrv_query($conn, $sql);
		if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
				
		
		// find artist id
		$sql = "SELECT id AS artistID FROM artist WHERE name='$artist'";
		$res = sqlsrv_query($conn, $sql);
		if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		$row = sqlsrv_fetch_array($res);
		$artistID = $row['artistID'];
		
		
		$sql = "INSERT INTO exhibit_artist VALUES('$exhibitID', '$artistID');";
		$res = sqlsrv_query($conn, $sql);
		if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		
		/* insert new exhibit's characteristics into the database*/
		
		if($type=='painting'){
			
			$sql = "INSERT INTO painting VALUES('$exhibitID', '$length', '$width');";
			$res = sqlsrv_query($conn, $sql);
			if($res)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
			
			
			
			
			$sql = "SELECT id FROM paint_type WHERE name='$paintType';";
			$res = sqlsrv_query($conn, $sql);
			if($res)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
		
			$row = sqlsrv_fetch_array($res);
		
			// if the paint type does not exist add it to the paint_type table
			if($row['id']==NULL){
				$sql = "SELECT max(id) AS maxPaint FROM paint_type";
				$res = sqlsrv_query($conn, $sql);
				if($res)
					{}
				else
					die( print_r( sqlsrv_errors(), true));
				
				$row = sqlsrv_fetch_array($res);
				$paintID = $row['maxPaint'] + 1;
				
				$sql = "INSERT INTO paint_type VALUES('$paintID', '$paintType');";
				$res = sqlsrv_query($conn, $sql);
				if($res)
					{}
				else
					die( print_r( sqlsrv_errors(), true));
			
				
			}
			else{
				$paintID = $row['id'];
			}
			// relate the exhibit to its paint type
			$sql = "INSERT INTO painting_paint_type VALUES('$exhibitID', '$paintID');";
			$res = sqlsrv_query($conn, $sql);
			if($res){
				echo 'New exhibit was inserted successfully';
			}
			else
				die( print_r( sqlsrv_errors(), true));
			
			

		}
		else if($type=='drawing'){
			
			$sql = "INSERT INTO drawing VALUES('$exhibitID', '$base', '$drawType');";
			$res = sqlsrv_query($conn, $sql);
			
			$sql = "SELECT id AS toolID FROM tool WHERE name='$tool';";
			$res = sqlsrv_query($conn, $sql);
			$row = sqlsrv_fetch_array($res);
			
			if($row['toolID']==NULL){
				$sql = "SELECT max(id) AS maxtoolID FROM tool;";
				$res = sqlsrv_query($conn, $sql);
				
				$toolID = $row['toolID']+1;
				
				$sql = "INSERT INTO tool VALUES('$toolID', '$tool');";
				$res = sqlsrv_query($conn, $sql);
				if($res)
					{}
				else
					die( print_r( sqlsrv_errors(), true));
				
			}else
				$toolID = $row['toolID'];
			
			// relate the exhibit to its tool
			$sql = "INSERT INTO drawing_tool VALUES('$exhibitID', '$toolID');";
			$res = sqlsrv_query($conn, $sql);
			
			if($res)
				echo 'New exhibit was inserted successfully';
			else
				die( print_r( sqlsrv_errors(), true));
			
			
			
			
		}	
		else if($type=='sculpture'){	
		
			$sql = "INSERT INTO sculpture VALUES('$exhibitID', '$height');";
			$res = sqlsrv_query($conn, $sql);
			
			$sql = "SELECT id AS materialID FROM material WHERE name='$material';";
			$res = sqlsrv_query($conn, $sql);
			$row = sqlsrv_fetch_array($res);
			
			if($row['materialID']==NULL){
				$sql = "SELECT max(id) AS maxMaterialID FROM material;";
				$res = sqlsrv_query($conn, $sql);
				
				$materialID = $row['maxMaterialID']+1;
				
				$sql = "INSERT INTO tool VALUES('$materialID', '$material');";
				$res = sqlsrv_query($conn, $sql);
				if($res)
					{}
				else
					die( print_r( sqlsrv_errors(), true));
				
			}else
				$materialID = $row['materialID'];
			
			
			// relate the exhibit to its material
			$sql = "INSERT INTO sculpture_material VALUES('$exhibitID', '$materialID');";
			$res = sqlsrv_query($conn, $sql);
			
			if($res)
				echo 'New exhibit was inserted successfully';
			else
				die( print_r( sqlsrv_errors(), true));
			
		
		}else{
			
			$sql = "INSERT INTO print_making VALUES('$exhibitID', '$technique');";
			$res = sqlsrv_query($conn, $sql);
			
			if($res)
				echo 'New exhibit was inserted successfully';
			else
				die( print_r( sqlsrv_errors(), true));
			
			
		}
	}	
?>

<br><a href="exhibits.php">Return to exhibits</a>