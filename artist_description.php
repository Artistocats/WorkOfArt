<?php
    require "database.php";
    include "header.php";
	
    if($conn)
    {
    	include "menu.php";
    	if (isset($_GET['id'])){
		$id=$_GET['id'];		
		

        $sql="SELECT name from artist where id=$id";
        $res = sqlsrv_query($conn, $sql);
        
        if($res)
            {
                $row = sqlsrv_fetch_array($res);
                
            ?>
            <h2 class="description"><?php echo $row['name']?></h2>
              
                    <?php
        }
        else
            die( print_r( sqlsrv_errors(), true));






        $sql = "SELECT title, exhibit_id from artist JOIN exhibit_artist ON
                artist.id=exhibit_artist.artist_id AND artist.id=$id JOIN exhibit ON
                exhibit_artist.exhibit_id=exhibit.id ;";
		
        $res = sqlsrv_query($conn, $sql);
        if($res)
			{
?>
			<table class="tablesorter desciption_table">
            <thead><tr class="table_head"><th> Exhibits </th></tr></thead>
<?php
				while($row = sqlsrv_fetch_array($res)) 
				{
?>
					<tr>
                    <td><?php echo "<a href='exhibit_description.php?id=".$row['exhibit_id']."'>".$row['title']."</a>";?></td>
					</tr>
<?php
            }
?>
        </table>

<?php
        }
		else
			die( print_r( sqlsrv_errors(), true));


         }else
            header( "Location: artists.php" );    	

     }
    else
        header( "Location: index.php" );

    include "footer.php";
	
?>
