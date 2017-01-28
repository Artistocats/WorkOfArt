<?php
	require "database.php";
	if($conn&&($_SESSION['admin']==1))
   	{
		print_r($_POST);
		$id= $_POST["id"];
		$name= $_POST["name"];
		$from_year= $_POST["from_year"];
		$until_year= $_POST["until_year"];
        $sql = "UPDATE art_movement 
				SET name='$name',from_year=$from_year,until_year=$until_year
				WHERE id=$id
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