<?php
	include("database.php");
	if($conn&&($_SESSION['admin']==1))
   	{
   		$artists = array();

   		$sql="SELECT name FROM artist";
   		$res = sqlsrv_query($conn, $sql);


		while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
  			$artists = array_merge( $artists, array_values($row) );
		}



   		$exhibit='';
   		if(isset($_GET['exhibit']))
			$exhibit=$_GET['exhibit'];



   		$sql="SELECT name FROM artist JOIN exhibit_artist ON
			  exhibit_artist.artist_id=artist.id JOIN exhibit ON
			  exhibit.id=exhibit_artist.exhibit_id AND exhibit.title='".$exhibit."'";
   		$res = sqlsrv_query($conn, $sql);
		if($res)
		{
			
			$c=0;
			while( $row = sqlsrv_fetch_array( $res, SQLSRV_FETCH_ASSOC))
			{
				echo "<select>";
				echo "<option>Unknown</option>";

					foreach ($artists as &$name)
					{
						if(strcmp($name,$row['name'])!=0)
							echo '<option value="'.$name.'">'.$name."</option>";
						else
							echo '<option value="'.$name.'" selected>'.$name."</option>";
					}

				echo "</select>";
				if($c==0)
					echo "<input type='button' class='add_select'/>";
				else
				{
					echo "<input type='button' class='add_select'/>";
					echo "<input type='button' class='remove_select'/>";
				}
				$c=$c+1;
			}
			



			
		}
	}
?>