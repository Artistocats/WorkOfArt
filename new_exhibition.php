<?php
	include "header.php";
	require "database.php";
	if($conn)
		include "menu.php";
	
?>	
<body>

<h4>Add new exhibition venue</h4>
<form action="add_exhibition.php" method="get">
<p>Name:
<input class="inputs" type="text" name="exhibitionName" maxlength="50" required/>
</p>
<p>Year of establishment:
<input class="inputs" type="text" name="yearEstablished"/>
</p>
<p><b>Location</b>:
<br>City:
<input class="inputs" type="text" name="city"/>
<br>Country:
<input class="inputs" type="text" name="country"/>
<br>Street:
<input class="inputs" type="text" name="street"/>
<br>Number:
<input class="inputs" type="text" name="num"/>
</p>
<p><input class="inputs" type="submit" value="OK" class="button"/></p>
</form>

</body>

<?php
include "footer.php";
?>