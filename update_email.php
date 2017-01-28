<?php
	require "database.php";

	if (isset($_POST['new_email']))
		$new_email=$_POST['new_email'];

    if($conn)
    {
        $sql = "UPDATE userAccount SET email='$new_email' WHERE username='".$_SESSION['username']."'";
		$res = sqlsrv_query($conn, $sql);
        if($res){
			echo 'Your e-mail was updated successfully';
		}
		else
			die( print_r( sqlsrv_errors(), true));

    }
	
?>