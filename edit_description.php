<?php
	include("database.php");
	if(($conn)&&($_SESSION['admin']==1))
	{	
		$id= $_POST['id'];
		$description=$_POST['description'];
    	
		$sql = "UPDATE exhibit SET description='".$description."'WHERE id=".$id.";";
		$res = sqlsrv_query($conn, $sql);
	
		if($res)
		{
			//error handling
		}
		else
			die( print_r( sqlsrv_errors(), true));
	}

	

?>