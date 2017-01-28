<?php
	include "header.php";
	require "database.php";
	if($conn)
		include "menu.php";
?>	
<body>

<h4>Add new movement</h4>
<form action="add_movement.php" method="get">
<p>Name:
<input class="inputs" type="text" name="movementName" maxlength="50" required/>
</p>
<p>From Year:
<input class="inputs" type="text" name="fromYear"/>
</p>
<p>Until Year:
<input class="inputs" type="text" name="untilYear"/>
</p>
<p><input class="inputs" type="submit" value="OK" class="button"/></p>
</form>

</body>

<?php
include "footer.php";
?>