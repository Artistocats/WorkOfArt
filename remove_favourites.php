<?php
    require "database.php";
	
	if (isset($_GET['id']))
		$id=$_GET['id'];

    if($conn)
    {
        $sql = "DELETE FROM favourites WHERE exhibit_id=$id AND username='".$_SESSION['username'] ."'";
		print_r($sql);
        $res = sqlsrv_query($conn, $sql);
        if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));

    }

	header("Location: exhibits.php");
	
?>
