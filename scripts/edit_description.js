$(document).ready(function() {
	//Initially hide the edit area
	$(".editDesc").hide();
	$(".cancel").hide();
});

$(document).ready(function(){
    $(".edit").click(function(){
		$(".editDesc").show();
		$(".edit").hide();
		$(".edit").siblings("span").hide();
		$(".cancel").show();
	});	
});


$(document).ready(function(){
    $(".cancel").click(function(){
		$(".editDesc").hide();
		$(".edit").show();
		$(".cancel").hide();
		$(".edit").siblings("span").show();
	});	
});




$(document).on('click', '.inputs', function()
{
		var id = $(this).attr('id');
    	var description = $(this).siblings("#txtArea").val();

		
        $.ajax({
			type: "POST",
			url: "edit_description.php",
			dataType: "html",
			data: {
				id: id,
				description : description
			},
			success: function(response){
				window.location.reload()
			},
			error: function() {
				//error handling
			}
		});
	
});   










