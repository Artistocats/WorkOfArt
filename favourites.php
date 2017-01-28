<?php
    require "database.php";
    include "header.php";
    echo "<body>";
    if($conn)
    {
        include "menu.php";
        $sql = "SELECT *  FROM
				(SELECT * FROM(
				SELECT IIF(exhibit.id=userFavourites.exhibit_id,1,0) AS book,exhibit.id AS id1,title, year_created,art_movement.name AS name1,exhibition.name AS name2, artist.name AS artist_name,
		        ROW_NUMBER() OVER(PARTITION BY exhibit.id ORDER BY exhibit.id DESC) rn
				FROM userFavourites LEFT JOIN exhibit
				ON userFavourites.exhibit_id=exhibit.id LEFT JOIN art_movement ON
				exhibit.movement_id=art_movement.id LEFT JOIN exhibition ON 
				exhibit.exhibition_id=exhibition.id LEFT JOIN exhibit_artist ON
				exhibit.id=exhibit_artist.exhibit_id LEFT JOIN artist ON
				exhibit_artist.artist_id=artist.id) a WHERE rn=1)b LEFT JOIN (select exhibit_id AS id2, count(exhibit_id) AS c FROM exhibit_artist group by exhibit_id)d ON 
				id1=id2
				;";
								
				
        $res = sqlsrv_query($conn, $sql);
        if($res)
        {
?>
         <script type="text/javascript" src="scripts/favourites.js"></script>
        <table id="myTable" class="tablesorter">
            <thead><tr class="table_head"><th>Exhibit</th><th>Year</th><th>Art Movement</th><th>Exhibition</th><th>Artist</th><th>Favourite</th></tr></thead><tbody>
<?php
            while($row = sqlsrv_fetch_array($res)) 
            {
?>
                <?php echo '<tr id="'.$row['id1'].'">';?>
                    <td><?php echo '<a href="exhibit_description.php?id='.$row['id1'].'">'.$row['title']?></a></td>
                    <td><?php echo $row['year_created']?></td>
					<td><?php echo $row['name1']?></td>
					<td><?php echo $row['name2']?></td>
					<?php
	
					if ($row['c']>1)
					{
						$str=",...";
					?>
				
					<td><?php echo $row['artist_name'].$str?></td>
					<?php 
					}
					else
                   {
				   ?>		
				   <td><?php echo $row['artist_name']?></td>
				   <?php 
                   } 
				   ?>
				   <?php 
					if ($row['book'])
                   {
					?>
						<td class="favourite"><span>1</span><input type="button" class="fav"/></td>
					<?php 
					}
					else
					{
						?>		
						<td class="favourite"><span>0</span><input type="button" class="no_fav"/></td>
						<?php 
					}
?>					
             </tr>

<?php
            }
?>
        </tbody></table>

<?php
        }
        else
            die( print_r( sqlsrv_errors(), true));
    }
    else
    {
        $_SESSION['fl']=4;
        header("Location: index.php");
    }

    include "footer.php";
?>
