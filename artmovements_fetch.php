<?php
	include("database.php");
	if($conn&&($_SESSION['admin']==1))
   	{
   		$sql="SELECT name FROM art_movement";
   		$res = sqlsrv_query($conn, $sql);
		if($res)
		{
			echo "<select>";
			if(isset($_GET['name']))
			{
				$name=$_GET['name'];
				while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC))
				{
					if(strcmp($name,$row['name'])!=0)
						echo '<option value="'.$row['name'].'">'.$row['name']."</option>";
					else
						echo '<option value="'.$row['name'].'" selected>'.$row['name']."</option>";
				}
			}
			else
			{
				while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC))
					echo '<option value="'.$row['name'].'">'.$row['name']."</option>";
		
			}


			echo "</select>";
		}
	}
?>