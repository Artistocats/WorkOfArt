<?php
    require "database.php";
    include "header.php";
    echo "<body>";
    if($conn)
    {
        include "menu.php";
        $sql = "SELECT id,name,from_year,until_year FROM
		        art_movement;";
        $res = sqlsrv_query($conn, $sql);
        if($res)
        {
            if($_SESSION['admin']==1)
                echo '<script type="text/javascript" src="scripts/movements.js"></script>';
            else
                echo '<script type="text/javascript" src="scripts/movements_user.js"></script>';
?>

        <table id="myTable" class="tablesorter movements_table">
            <thead><tr class="table_head"><th>Art Movement</th><th>From</th><th>Until</th>
<?php
            if($_SESSION['admin']==1)
                echo '<th class="nosort"><a href="new_movement.php"><img src="images/add.png"></a></th>';

            echo "</tr></thead><tbody>  ";
            while($row = sqlsrv_fetch_array($res))
            {
?>
                <?php echo '<tr id="'.$row['id'].'">';?>

                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextName"';?>><?php echo '<a href="movement_description.php?id='.$row['id'].'">'.$row['name'];?></a></span></td>

                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextFromYear"';?>><?php echo $row['from_year']?></span></td>
                    <td><span <?php if($_SESSION['admin']==1) echo 'class="editTextUntilYear"';?>><?php echo $row['until_year']?></span></td>

<?php           if($_SESSION['admin']==1)
                {
                    $del="do_delete.php?movement_id=".$row['id'];
                    ?>
                    <td class="nosort"><input type="button" class="edit"/><input type="button" class="delete" onclick="javascript:show_confirm('<?php echo htmlspecialchars($del); ?>');"/></td>
                    <?php
                }   ?>


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
