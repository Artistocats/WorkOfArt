<?php
	require "database.php";
	include "header.php";

	if($conn)
    {
    	include "menu.php";

    	$searchqE = $_GET['searchE'];
        $searchqA = $_GET['searchA'];

		//if exhibit field is empty
        if ($searchqE==NULL){	

			$sql = "SELECT artist.id AS id,name,year_of_birth, year_of_death, city_country.country AS place_of_birth 
					FROM artist JOIN city_country ON
					artist.place_of_birth_id=city_country.id AND name LIKE '%$searchqA%';";		
        	$res = sqlsrv_query($conn, $sql);
        	if($res)
        	{	
				$count=0;
           		while($row = sqlsrv_fetch_array($res))
            	{
            		$count++;
					if ($count==1){
?>						
						<script type="text/javascript" src="scripts/artists_user.js"></script>
						<table id="myTable" class="tablesorter artists_table">
						<thead><tr class="table_head"><th>Artist</th><th>Born</th><th>Died</th><th>Birthplace</th></tr></thead><tbody>
<?php						
					}

?>					
                	<tr>
                	
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['year_of_birth']?></td>
                    <td><?php echo $row['year_of_death']?></td>
                    <td><?php echo $row['place_of_birth']?></td>
                	
                	</tr>                
<?php  
				}
?>
        		</tbody></table>
        		

<?php
				if ($count==0){
?>
					</br>

					<center>
					</br>
					<h2><i>Sorry...</i></h2>
					</br>
					
					<img src="images/sorry.png" alt="sorry" style="width:200px;height:200px;">
					<h2><i> No results found!</i></h2>
					</center>	
<?php
				}
					
        	}

    		else
        	{
        	       
        		die( print_r( sqlsrv_errors(), true));

        	}
		}
		elseif ($searchqA==NULL){	//artist field empty
			$sql = "SELECT *  FROM
					(SELECT *  FROM
					(SELECT * FROM (SELECT exhibit.id AS id1,title,year_created,art_movement.name AS name1,exhibition.name AS name2, artist.name AS artist_name,
					ROW_NUMBER() OVER(PARTITION BY exhibit.id ORDER BY exhibit.id DESC) rn
					FROM exhibit LEFT JOIN art_movement ON
					exhibit.movement_id=art_movement.id LEFT JOIN exhibition ON 
					exhibit.exhibition_id=exhibition.id LEFT JOIN exhibit_artist ON
					exhibit.id=exhibit_artist.exhibit_id LEFT JOIN artist ON
					exhibit_artist.artist_id=artist.id)a WHERE rn=1)b LEFT JOIN (select exhibit_id AS id2, count(exhibit_id) AS c FROM exhibit_artist group by exhibit_id)d ON 
					id1=id2)EX
					WHERE title LIKE '%$searchqE%'
					;";					    
        	$res = sqlsrv_query($conn, $sql);
        	if($res)
        	{	
				$count=0;
           		while($row = sqlsrv_fetch_array($res))
            	{
            		$count++;
					if ($count==1){
?>						
						<script type="text/javascript" src="scripts/exhibits_user.js"></script>
						<table id="myTable" class="tablesorter artists_table">
						<thead><tr class="table_head"><th>Exhibit</th><th>Year</th><th>Art Movement</th><th>Exhibition</th><th>Artist</th></tr></thead><tbody>
<?php						
					}

?>					
                	<tr>
                	
                    <td><?php echo '<a href="exhibit_description.php?id='.$row['id1'].'">'.$row['title'];?></a></td>
                    <td><?php echo $row['year_created']?></td>
                    <td><?php echo $row['name1']?></td>
                    <td><?php echo $row['name2']?></td>
<?php					
					if ($row['c']>1){
?>
						<td><?php echo $row['artist_name'].",...";?></td>
<?php			
					}
					else{
?>						
						<td><?php echo $row['artist_name'];?></td>
<?php						
					}
?>
						
                	</tr>                
<?php  
				}
?>
        		</tbody></table>
        	

<?php
				if ($count==0)
				{
?>
					</br>

					<center>

					</br>
					<h2><i>Sorry...</i></h2>
					</br>
					
					<img src="images/sorry.png" alt="sorry" style="width:200px;height:200px;">
					<h2><i> No results found!</i></h2>
					</center>	
<?php
				}
					
        	}

    		else
        	{
        	       
        		die( print_r( sqlsrv_errors(), true));

        	}
		}

		else{
			$sql = "SELECT *  FROM
					(SELECT *  FROM
					(SELECT * FROM (SELECT exhibit.id AS id1,title,year_created,art_movement.name AS name1,exhibition.name AS name2, artist.name AS artist_name,
					ROW_NUMBER() OVER(PARTITION BY exhibit.id ORDER BY exhibit.id DESC) rn
					FROM exhibit LEFT JOIN art_movement ON
					exhibit.movement_id=art_movement.id LEFT JOIN exhibition ON 
					exhibit.exhibition_id=exhibition.id LEFT JOIN exhibit_artist ON
					exhibit.id=exhibit_artist.exhibit_id LEFT JOIN artist ON
					exhibit_artist.artist_id=artist.id )a WHERE rn=1)b LEFT JOIN (select exhibit_id AS id2, count(exhibit_id) AS c FROM exhibit_artist group by exhibit_id)d ON 
					id1=id2) EX
					WHERE title LIKE '%$searchqE%' AND artist_name like '%$searchqA%'
					;";			    
        	$res = sqlsrv_query($conn, $sql);
        	if($res)
        	{	
				$count=0;
           		while($row = sqlsrv_fetch_array($res))
            	{
            		$count++;
					if ($count==1){
?>						
						<center>
						<table>
						<thead><tr class="table_head"><th>Exhibit</th><th>Year</th><th>Art Movement</th><th>Exhibition</th><th>Artist</th><tr>
<?php						
					}

?>					
                	<tr>
                	
                    <td><?php echo '<a href="exhibit_description.php?id='.$row['id1'].'">'.$row['title'];?></a></td>
                    <td><?php echo $row['year_created']?></td>
                    <td><?php echo $row['name1']?></td>
                    <td><?php echo $row['name2']?></td>
<?php					
					if ($row['c']>1){
?>
						<td><?php echo $row['artist_name'].",...";?></td>
<?php			
					}
					else{
?>						
						<td><?php echo $row['artist_name'];?></td>
<?php						
					}
?>
						
                	</tr>                
<?php  
				}
?>
        		</table>
        		</center>

<?php
				if ($count==0)
				{
?>
					</br>

					<center>

					</br>
					<h2><i>Sorry...</i></h2>
					</br>
					
					<img src="images/sorry.png" alt="sorry" style="width:200px;height:200px;">
					<h2><i> No results found!</i></h2>
					</center>	
<?php
				}
					
        	}

    		else
        	{
        	       
        		die( print_r( sqlsrv_errors(), true));

        	}

		}

	}
	else
    {
        $_SESSION['fl']=4;
        header("Location: index.php");
    }

    include "footer.php";

?>