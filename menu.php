<?php
	echo '<img src="images/logo.png" alt="logo" id="logo" />';
	echo '<ul id="bar"><li><a href="index.php">Home</a></li>';
	echo '<li><a href="movements.php">Movements</a></li>';
	echo '<li><a href="artists.php">Artists</a></li>';
	echo '<li><a href="exhibits.php">Exhibits</a></li>';
	echo '<li><a href="exhibitions.php">Exhibitions</a></li>';
	echo '<li><a href="favourites.php">Favourites</a></li>';
	if($_SESSION['admin']==1)
		echo '<li><a href="users.php">Users</a></li>';
	echo '<li><a href="account.php">Account</a></li>';
	echo '<li><a href="do_logout.php">Logout</a></li></ul>';
?>