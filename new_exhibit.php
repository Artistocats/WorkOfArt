<?php
	require "database.php";
	include "header.php";
	include "menu.php";
?>

<body>

<div>
	<h4>Add new exhibit</h4>
	<form action="add_exhibit.php" method="get">
    <label for="title">Title</label>
    <input class="inputs" type="text" name="title" maxlength="50" required/>

	<label for="artist">Artist</label>
    <select class="inputs" name="artist">

<?php
		if($conn){
			$sql = "SELECT name AS artistName FROM artist;";
			$res= sqlsrv_query($conn, $sql);
		}
		else
			die( print_r( sqlsrv_errors(), true));

		while ($row = sqlsrv_fetch_array($res)) {
			echo '<option value="'.$row['artistName'].'">'.$row['artistName'].'</option>';
		}
		echo '<option value="None" selected="selected"></option>';

?>
    </select>
	
    <label for="yearCreated">Year of creation</label>
	<input class="inputs" type="text" name="yearCreated"/>
	
	<label for="type">Exhibit Type</label><br><br>
	<input type="radio" name="type" value="painting"> Painting
	<input type="radio" name="type" value="drawing"> Drawing
	<input type="radio" name="type" value="sculpture"> Sculpture
	<input type="radio" name="type" value="printmaking"> Print-making</br>
	
	<script type="text/javascript" src="scripts/exhibitType.js"></script>
	
	<div class="paint">
		<h4>Characteristics</h4>
		<label for="length">Length</label>
		<input class="inputs" type="number" step="0.01" name="length"/>
		
		<label for="width">Width</label>
		<input class="inputs" type="number" step="0.01" name="width"/>
		
			
		<label for="paintType">Types of paint</label>
		<input class="inputs" type="text" name="paintType" ><br><br>
		
		
	</div>
	
	<div class="draw">
		<h4>Characteristics</h4>
		<label for="drawType">Type of drawing</label>
		<input class="inputs" type="text" name="drawType"/>
		
		<label for="base">Base used</label>
		<input class="inputs" type="text" name="base"/>
		
		<label for="tool">Tools used</label>
		<input class="inputs" type="text" name="tool"/>
	</div>
	
	<div class="sculpt">
		<h4>Characteristics</h4>
		<label for="height">Height</label>
		<input class="inputs" type="number" step="0.01" name="height"/>
		
		<label for="material">Material</label>
		<input class="inputs" type="text" name="material"/>
		
	</div>
	
	<div class="print">
		<h4>Characteristics</h4>
		<label for="technique">Technique</label>
		<input class="inputs" type="text" name="technique"/>
	</div>
		
	
	<br>
    <label for="description">Description</label>
	<textarea class="inputs" name="description" rows=2 cols=100></textarea>
	
	<label for="movement">Art Movement</label>
    <select class="inputs" name="movement">

<?php
		if($conn){
			$sql = "SELECT name AS movementName FROM art_movement;";
			$res= sqlsrv_query($conn, $sql);
		}
		else
			die( print_r( sqlsrv_errors(), true));

		while ($row = sqlsrv_fetch_array($res)) {
			echo '<option value="'.$row['movementName'].'">'.$row['movementName'].'</option>';
		}
		echo '<option value="None" selected="selected"></option>';
?>
    </select>
	
	<label for="exhibition">Exhibition Venue</label>
    <select class="inputs" name="exhibition">

<?php
		if($conn){
			$sql = "SELECT name AS exhibName FROM exhibition;";
			$res= sqlsrv_query($conn, $sql);
		}
		else
			die( print_r( sqlsrv_errors(), true));

		while ($row = sqlsrv_fetch_array($res)) {
			echo '<option value="'.$row['exhibName'].'">'.$row['exhibName'].'</option>';
		}
		echo '<option value="None" selected="selected"></option>';

?>
    </select>
  
    <input class="inputs" type="submit" value="Submit">
	</form>
</div>

</body>
</html>

<?php
include "footer.php";
?>