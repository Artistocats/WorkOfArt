<?php
	require "database.php";
	include "header.php";

	if($conn)
	{
		include "menu.php";
		$sql = "SELECT email FROM userAccount;";
		$res = sqlsrv_query($conn, $sql);

		if($res)
		{
			$account = sqlsrv_fetch_array($res);
			echo ' <script type="text/javascript" src="scripts/account.js"></script>';
			echo '<div id="account"><span class="user_details">Username:  </span>'.$_SESSION['username'];
			echo '<br><span class="user_details">Email:  </span><span id="email">'.$account['email'].'</span>&nbsp;&nbsp;&nbsp;<img class="edit" src="images/edit.png"/></div>';
		}
	}
	else
	{
		$_SESSION['fl']=4;
		header("Location: index.php");
	}

	//TODO else return to index "Please login first"
	include "footer.php";
?>
