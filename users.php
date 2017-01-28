<?php
    require "database.php";
    include "header.php";
    echo "<body>";
    if(($conn)&&($_SESSION['admin']==1))
    {
    	include "menu.php";
    	$sql="SELECT * FROM users;" ;
    	$res = sqlsrv_query($conn, $sql);
    	if($res)
        {
?>
			
        	<script type="text/javascript" src="scripts/users.js"></script>
            <table id="myTable" class="tablesorter users_table">
            <thead><tr class="table_head"><th>Username</th><th>Email</th><th class="nosort"></th></tr></thead><tbody>
            

<?php
			while($row = sqlsrv_fetch_array($res)) 
            {
				 echo '<tr id="'.$row['username'].'">'; 
?>             
                
                   <td><span <?php echo 'class="editTextUsername"';?>><?php echo $row['username']?></span></td>
                   <td><span <?php echo 'class="editTextEmail"';?>><?php echo $row['email']?></span></td>
                
                <?php
                $del="do_delete.php?username=".$row['username'];
                    ?>
                    <td class="nosort"><input type="button" class="edit"/><input type="button" class="delete" onclick="javascript:show_confirm('<?php echo htmlspecialchars($del); ?>');"/></td>

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
