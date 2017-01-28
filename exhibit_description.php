<?php
    require "database.php";
    include "header.php";
	
    if($conn)
    {
    	include "menu.php";
    	if (isset($_GET['id']))
    	{
		$id=$_GET['id'];

	
        $sql = "SELECT title, name, artist_id from exhibit JOIN exhibit_artist ON
				exhibit.id=exhibit_artist.exhibit_id AND exhibit.id=$id JOIN artist ON
				exhibit_artist.artist_id=artist.id ";
		
        $res = sqlsrv_query($conn, $sql);
        if($res)
		{
		?>

					
		<?php
						$c=0;
						while($row = sqlsrv_fetch_array($res)) 
						{
							if($c==0)
							{
								echo "<h2 class='description'>".$row['title']."</h2>";?>
								<table class="tablesorter desciption_table">
            <thead><tr class="table_head"><th>Artist</th></tr></thead><tbody>
						<?php	}
		?>
							<tr>
		                    <td><?php echo "<a href='artist_description.php?id=".$row['artist_id']."'>".$row['name']."</a>";?></td>
							</tr>
							
		<?php
		            	}
		?>
		        </tbody></table>

		<?php
		}
		else
			die( print_r( sqlsrv_errors(), true));	

        	
		
		$sql = "SELECT exhibit_id AS exID from painting WHERE exhibit_id=$id";
        $res = sqlsrv_query($conn, $sql);
        if($res)
			{}
		else
			die( print_r( sqlsrv_errors(), true));
		
		$row = sqlsrv_fetch_array($res);
		$ExhType = 'painting';
		
		if($row['exID']==NULL){
			$sql = "SELECT exhibit_id AS exID from drawing WHERE exhibit_id=$id";
			$res = sqlsrv_query($conn, $sql);
			if($res)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
		
			$row = sqlsrv_fetch_array($res);
			$ExhType = 'drawing';	
		}
		
		if($row['exID']==NULL){
			$sql = "SELECT exhibit_id AS exID from sculpture WHERE exhibit_id=$id";
			$res = sqlsrv_query($conn, $sql);
			if($res)
				{}
			else
				die( print_r( sqlsrv_errors(), true));
		
			$row = sqlsrv_fetch_array($res);
			$ExhType = 'sculpture';	
		}
		
		if($row['exID']==NULL){
			$ExhType = 'printMaking';
		}
		
		
		if($ExhType == 'painting'){
			
			$sql = "SELECT * 
						FROM (SELECT dbo.painting.exhibit_id, dbo.painting.length, dbo.painting.width, dbo.exhibit.title, dbo.paint_type.name
						FROM  dbo.exhibit INNER JOIN
						painting ON dbo.exhibit.id = dbo.painting.exhibit_id INNER JOIN
						dbo.painting_paint_type ON dbo.painting.exhibit_id = dbo.painting_paint_type.exhibit_id INNER JOIN
						dbo.paint_type ON dbo.painting_paint_type.paint_type_id = dbo.paint_type.id) A
					WHERE A.exhibit_id=$id;";
				
		}else if($ExhType == 'drawing'){
			
			$sql = "SELECT * 
					FROM (SELECT   drawing.exhibit_id, exhibit.title, drawing.type, drawing.base, tool.name
						FROM drawing INNER JOIN drawing_tool
						ON drawing.exhibit_id = drawing_tool.exhibit_id 
						INNER JOIN exhibit 
						ON drawing.exhibit_id = exhibit.id
						INNER JOIN tool ON drawing_tool.tool_id = tool.id) A
					WHERE A.exhibit_id=$id;";
			
		}else if($ExhType == 'sculpture'){
			
			$sql = "SELECT * 
					FROM (SELECT sculpture.exhibit_id, sculpture.height, exhibit.title, material.name
						FROM exhibit INNER JOIN sculpture
						ON exhibit.id = sculpture.exhibit_id 
						INNER JOIN sculpture_material ON sculpture.exhibit_id = sculpture_material.exhibit_id
						INNER JOIN material ON sculpture_material.material_id = material.id)A
					WHERE A.exhibit_id=$id;";
			
		}else{
			
			$sql = "SELECT * 
					FROM (SELECT print_making.exhibit_id, exhibit.title, print_making.technique
						FROM exhibit INNER JOIN
						print_making ON exhibit.id = print_making.exhibit_id)A
					WHERE A.exhibit_id=$id;";
			
		}	
				
        $res = sqlsrv_query($conn, $sql);
		$row = sqlsrv_fetch_array($res);

        if($res)
			{
?>
			
			<table class="tablesorter desciption_table">
            <thead><tr class="table_head"><th> Exhibit Type </th></tr></thead>
			
<?php
			if($ExhType=='painting'){
?>				
				<tr><td> Painting </td>
			</table>
			
				<table class="tablesorter desciption_table">
				<thead><tr class="table_head"><th colspan="3"> Characteristics </th></tr></thead>
				<tr class="table_head"><th> Length (cm) </th><th> Width (cm) </th><th> Paint Type </th></tr>
				<tr><td><?php echo $row['length']?></td><td><?php echo $row['width']?></td><td><?php echo $row['name']?></td>
			
<?php				
			
				while($row = sqlsrv_fetch_array($res)) 
				{
?>
					<tr><td></td><td></td>
                    <td><?php echo $row['name']?></td>
					</tr>
<?php
				}
?>
				</table>
<?php					
			}else if($ExhType=='drawing'){
?>				
				<tr><td> Drawing </td>
			</table>
			
				<table class="tablesorter desciption_table">
				<thead><tr class="table_head"><th colspan="3"> Characteristics </th></tr></thead>
				<tr class="table_head"><th>Drawing Type</th><th>Base</th><th>Tool</th></tr>
				<tr><td><?php echo $row['type']?></td><td><?php echo $row['base']?></td><td><?php echo $row['name']?></td></tr>
				
<?php				
			
				while($row = sqlsrv_fetch_array($res)) 
				{
?>
					<tr><td></td><td></td>
                    <td><?php echo $row['name']?></td>
					</tr>
<?php
				}
?>
				</table>	
<?php				
			}else if($ExhType=='sculpture'){
?>				
				<tr><td>Sculpture</td>
			</table>
			
				<table class="tablesorter desciption_table">
				<thead><tr class="table_head"><th colspan="2"> Characteristics </th></tr></thead>
				<tr class="table_head"><th>Height</th><th>Material</th></tr>
				<tr><td><?php echo $row['height']?></td><td><?php echo $row['name']?></td></tr>
				
<?php				
			
				while($row = sqlsrv_fetch_array($res)) 
				{
?>
					<tr><td></td><td></td>
                    <td><?php echo $row['name']?></td>
					</tr>
<?php
				}
?>
				</table>	
<?php				
			}else{
?>				
				<tr><td> Print-Making </td>
			</table>
			
				<table class="tablesorter desciption_table">
				<thead><tr class="table_head"><th align="center" > Characteristics </th></tr></thead>
				<tr class="table_head"><th align="center" >Technique</th></tr>
				<tr><td align="center" ><?php echo $row['technique']?></td></tr>
				</table>	
<?php				
			}		
				
		
		
        }
		else
			die( print_r( sqlsrv_errors(), true));		

		
		$sql = "SELECT description from exhibit WHERE id=$id";
        $res = sqlsrv_query($conn, $sql);
		
        if($res)
		{
				$row = sqlsrv_fetch_array($res);
?>
				<script type="text/javascript" src="scripts/edit_description.js"></script>
				
				<div class="description"><h4>Description</h4><input type="button" class="cancel"/>
<?php				
				echo "<span>".$row['description']."</span>";
				if($_SESSION['admin']==1)
				{
									
					echo '&nbsp&nbsp'?><input type="button" class="edit"/>

					<div class="editDesc">
						<textarea id="txtArea" name="new_descript" rows=2 cols=100><?php echo $row['description']?></textarea>

						<?php echo '<input class="inputs" id='.$id.' type="submit" value="submit">'; ?>
						
					</div></div>
<?php					
				}		
		}
		else
			die( print_r( sqlsrv_errors(), true));

		include "footer.php";
		}
		else
			header( "Location: exhibits.php" );
    }
    else
    	header( "Location: index.php" );


    
	
?>

