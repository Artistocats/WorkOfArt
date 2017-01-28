<?php
    require "database.php";
    include "header.php";
    echo "<body>";
    if($conn)
    {
        include "menu.php";
        $sql = "SELECT artist.id AS id,name,year_of_birth, year_of_death, city_country.country AS place_of_birth
		        FROM artist JOIN city_country ON
                artist.place_of_birth_id=city_country.id;";
        $res = sqlsrv_query($conn, $sql);
        if($res)
        {
             if($_SESSION['admin']==1)
                echo ' <script type="text/javascript" src="scripts/artists.js"></script>';
            else
                echo ' <script type="text/javascript" src="scripts/artists_user.js"></script>';
?>
       <div id="scroll_artist">
        <table id="myTable" class="tablesorter artists_table">
            <thead><tr class="table_head"><th>Artist</th><th>Born</th><th>Died</th><th>Birthplace</th>
<?php
            if($_SESSION['admin']==1)
                echo '<th class="nosort"><a href="new_artist.php"><img src="images/add.png"></a></th>';

            echo "</tr></thead><tbody>  ";
            while($row = sqlsrv_fetch_array($res))
            {
?>
                <?php echo '<tr id="'.$row['id'].'">';?>


                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextName"';?>><?php echo '<a href="artist_description.php?id='.$row['id'].'">'.$row['name'];?></a></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextBirthYear"';?>><?php echo $row['year_of_birth']?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextDeathYear"';?>><?php echo $row['year_of_death']?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="dropDownBirthPlace"';?>><?php echo $row['place_of_birth']?></span></td>
<?php           if($_SESSION['admin']==1)
                {
                    $del="do_delete.php?artist_id=".$row['id'];
                    ?>
                    <td class="nosort"><input type="button" class="edit"/><input type="button" class="delete" onclick="javascript:show_confirm('<?php echo htmlspecialchars($del); ?>');"/></td>
                    <?php
                }   ?>


                </tr>
<?php
            }
?>
        </tbody></table>
        </div>

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
