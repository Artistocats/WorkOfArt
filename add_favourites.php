<?php
    require "database.php";
	
	if (isset($_GET['id']))
		$id=$_GET['id'];
	else
		die( print_r( sqlsrv_errors(), true));

    if($conn)
    {
        $sql = "Insert INTO favourites VALUES('".$_SESSION['username'] ."',$id)";
		print_r($sql);
        $res = sqlsrv_query($conn, $sql);
        if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));

    }

	//header("Location: exhibits.php");
?>
