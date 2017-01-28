<?php if($conn) { ?>
<script type="text/javascript" src="scripts/footer.js"></script>
<div id="search_bar">
	<form  action = 'do_search.php' method = 'GET' >
		<span><input type = 'text' class="bar_input" maxlength='50' name= 'searchE' placeholder="exhibit" required></span>

		<span><input type = 'text' class="bar_input" maxlength='50' name= 'searchA' placeholder="artist" required></span>

		<span><input type="image" class="submit_btn" src="images/search.png" alt="Submit" /></span>


	</form>
</div>
<?php } ?>
</body>
</html>
