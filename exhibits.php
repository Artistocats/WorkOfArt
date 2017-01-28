<?php
    require "database.php";
    include "header.php";
    echo "<body>";
    if($conn)
    {
        include "menu.php";
		$sql="SELECT SUM(exhibit_id) AS sum_id FROM userFavourites;";
		$res = sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);
		if($res)
        {
			//If the user has at least one favourite exhibit
			if ( $row['sum_id']>0){

				$sql = "SELECT * FROM
						(SELECT * FROM
						(SELECT IIF(exhibit.id=userFavourites.exhibit_id,1,0) AS book,exhibit.id AS id1,title,year_created,art_movement.name AS name1,exhibition.name AS name2,artist.name AS artist_name,
						ROW_NUMBER() OVER(PARTITION BY exhibit.id ORDER BY exhibit.id DESC) rn
						FROM exhibit  JOIN userFavourites
						ON exhibit.id!=ALL(SELECT userFavourites.exhibit_id FROM userFavourites) LEFT JOIN art_movement ON
						exhibit.movement_id=art_movement.id LEFT JOIN exhibition ON
						exhibit.exhibition_id=exhibition.id LEFT JOIN exhibit_artist ON
						exhibit.id=exhibit_artist.exhibit_id LEFT JOIN artist ON
						exhibit_artist.artist_id=artist.id
						UNION
						SELECT IIF(exhibit.id=userFavourites.exhibit_id,1,0) AS book,exhibit.id AS id1,title,year_created,art_movement.name AS name1,exhibition.name AS name2, artist.name AS artist_name,
						ROW_NUMBER() OVER(PARTITION BY exhibit.id ORDER BY exhibit.id DESC) rn
						FROM exhibit  JOIN userFavourites  ON
						exhibit.id=userFavourites.exhibit_id LEFT JOIN art_movement ON
						exhibit.movement_id=art_movement.id LEFT JOIN exhibition ON
						exhibit.exhibition_id=exhibition.id LEFT JOIN exhibit_artist ON
						exhibit.id=exhibit_artist.exhibit_id LEFT JOIN artist ON
						exhibit_artist.artist_id=artist.id
						)a WHERE rn=1)b LEFT JOIN (select exhibit_id AS id2, count(exhibit_id) AS c FROM exhibit_artist group by exhibit_id)d ON
						id1=id2
						ORDER BY id1 ASC
						;";
			}
			//If the user has not any favourite exhibits
			else{
				$sql = "SELECT *  FROM
						(SELECT * FROM(SELECT IIF(exhibit.id>0,0,1) AS book,exhibit.id AS id1,title,year_created,art_movement.name AS name1,exhibition.name AS name2, artist.name AS artist_name,
						ROW_NUMBER() OVER(PARTITION BY exhibit.id ORDER BY exhibit.id DESC) rn
						FROM exhibit LEFT JOIN art_movement ON
						exhibit.movement_id=art_movement.id LEFT JOIN exhibition ON
						exhibit.exhibition_id=exhibition.id LEFT JOIN exhibit_artist ON
						exhibit.id=exhibit_artist.exhibit_id LEFT JOIN artist ON
						exhibit_artist.artist_id=artist.id)a WHERE rn=1)b LEFT JOIN (select exhibit_id AS id2, count(exhibit_id) AS c FROM exhibit_artist group by exhibit_id)d ON
						id1=id2
						;";

			}
		}
		else
            die( print_r( sqlsrv_errors(), true));

		$res = sqlsrv_query($conn, $sql);
        if($res)
        {
        	if($_SESSION['admin']==1)
        		echo ' <script type="text/javascript" src="scripts/exhibits.js"></script>';
        	else
        		echo ' <script type="text/javascript" src="scripts/exhibits_user.js"></script>';
?>
       	<div id="scroll_exhibit">
        <table id="myTable" class="tablesorter">

            <thead><tr class="table_head"><th>Exhibit</th><th>Year</th><th>Art Movement</th><th>Exhibition</th><th>Artist</th><th>Favourite</th>
<?php
            if($_SESSION['admin']==1)
                echo '<th class="nosort"><a href="new_exhibit.php"><img src="images/add.png"></a></th>';

            echo "</tr></thead><tbody>  ";


            while($row = sqlsrv_fetch_array($res))
            {
?>
                <?php echo '<tr id="'.$row['id1'].'">';?>

					<td><span <?php if($_SESSION['admin']==1) echo 'class="editTextExhibit"';?>><?php echo '<a href="exhibit_description.php?id='.$row['id1'].'">'.$row['title'];?></a></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextYear"';?>><?php echo $row['year_created']?></span></td>
					<td><span <?php if($_SESSION['admin']==1) echo 'class="dropDownMovement"';?>><?php echo $row['name1']?></span></td>
					<td><span <?php if($_SESSION['admin']==1) echo 'class="dropDownExhibition"';?>><?php echo $row['name2']?></span></td>



				<td class="ddA">
					<?php
						if($_SESSION['admin']==1)
							echo "<span class='editable dropDownArtist'>";
						else
							echo ">";

						if ($row['c']>1)
							echo $row['artist_name'].",...";
						else
							echo $row['artist_name'];

						if($_SESSION['admin']==1)
							echo "</span>";
					?>
				</td>

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
                if($_SESSION['admin']==1)
                {
                    $del="do_delete.php?exhibit_id=".$row['id1'];
                    ?>
                    <td class="nosort"><input type="button" class="edit"/><input type="button" class="delete" onclick="javascript:show_confirm('<?php echo htmlspecialchars($del); ?>');"/></td>
                    <?php
                }   ?>

            </tr>

<?php
            }
?>
        </tbody> </div>  </table>


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
