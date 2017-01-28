<?php
    require "database.php";
    include "header.php";
    echo "<body>";
    if($conn)
    {
        include "menu.php";
        $sql = "SELECT exhibition.id AS id,name,year_established, city_country.country AS Country,
                        city_country.city AS City, location.street AS Street, location.number AS Num
                        FROM exhibition JOIN location
                        ON location.id=exhibition.location_id JOIN city_country ON
                        location.city_country_id=city_country.id;";
        $res = sqlsrv_query($conn, $sql);
        if($res)
        {
            if($_SESSION['admin']==1)
                echo '<script type="text/javascript" src="scripts/exhibitions.js"></script>';
            else
               echo '<script type="text/javascript" src="scripts/exhibitions_user.js"></script>';

?>
            <div id="scroll_exhibition">
            <table id="myTable" class="tablesorter exhibitions_table">
            <thead><tr class="table_head"><th>Exhibition</th><th>Year Established</th><th>Country</th><th>City</th><th>Street</th><th>Number</th>
<?php
            if($_SESSION['admin']==1)
                echo '<th class="nosort"><a href="new_exhibition.php"><img src="images/add.png"></a></th>';

            echo "</tr></thead><tbody>  ";
            while($row = sqlsrv_fetch_array($res))
            {
?>
                <?php echo '<tr id="'.$row['id'].'">';?>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextName"';?>><?php echo $row['name'];?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextYear"';?>><?php echo $row['year_established']?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="dropDownCountry"';?>><?php echo $row['Country']?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextCity"';?>><?php echo $row['City']?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextStreet"';?>><?php echo $row['Street']?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextNum"';?>><?php echo $row['Num']?></span></td>




<?php           if($_SESSION['admin']==1)
                {
                    $del="do_delete.php?exhibition_id=".$row['id'];
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
