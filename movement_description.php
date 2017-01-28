<?php
    require "database.php";
    include "header.php";
	
    if($conn)
    {
    	include "menu.php";
    	if (isset($_GET['id'])){
		$id=$_GET['id'];
		
		$sql="SELECT art_movement.name from art_movement where art_movement.id=$id";
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

        


        $sql = "SELECT artist.name, artist.id from art_movement JOIN artist_movement ON
                art_movement.id=artist_movement.movement_id AND art_movement.id='$id' JOIN artist ON
                artist_movement.artist_id=artist.id;";
		
        $res = sqlsrv_query($conn, $sql);
        if($res)
			{
?>
            <table class="tablesorter desciption_table">
            <thead><tr class="table_head"><th> Artists </th></tr></thead>
			
<?php
				while($row = sqlsrv_fetch_array($res)) 
				{
?>
					<tr>
                    <td><?php echo "<a href='artist_description.php?id=".$row['id']."'>".$row['name']."</a>";?></td>
					</tr>
<?php
            }
?>
        </table>

<?php
        }
		else
			die( print_r( sqlsrv_errors(), true));
        include "footer.php";
        }
        else
            header( "Location: movements.php" );	

    }
    else
        header( "Location: index.php" );


    
	
?>
