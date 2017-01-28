<?php
	include "header.php";
	require "database.php";
	if($conn)
		include "menu.php";
?>	
<body>

<h4>Add new artist</h4>
<form action="add_artist.php" method="get">
<p>Name:
<input class="inputs" type="text" name="artistName" maxlength="50" required/>
</p>
<p>Year Born:
<input class="inputs" type="text" name="yearBorn"/>
</p>
<p>City:
<input class="inputs" type="text" name="birthCity"/>
</p>
<p>Country:
<input class="inputs" type="text" name="birthCountry"/>
</p>
<p>Year Died:
<input class="inputs" type="text" name="yearDied"/>
</p>
<p><input class="inputs" type="submit" value="OK" class="button"/></p>
</form>

</body>

<?php
include "footer.php";
?>